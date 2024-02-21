<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;

use App\Models\Inscripcion;
use App\Models\ConfInscripcion;
use App\Models\Periodo;
use App\Models\Alumno;
use App\Models\Infoseccion;
use App\Models\Master;
use App\Models\Preinscrito;
use App\Models\PagoUc;
use App\Models\Nota;
use App\Models\Plan;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class InscripcionController extends Controller
{
    public function index(Request $request)
    {
        // Valido que las inscripciones esten abiertas para el periodo activo
 
        $hoy = now()->format('Y-m-d');
        // Busco el periodo activo (el ultimo porsi por error hay mas de uno)  
        $periodo = Periodo::select('id', 'nombre as nperiodo')
             ->where('activo', 1)
             ->orderByDesc('id')
             ->first();
        if($periodo){      
          $conf = ConfInscripcion::select('fecha_ini', 'fecha_fin')
             ->where('periodo_id', $periodo->id)
             ->where(function ($query) use ($hoy) {
                $query->where('fecha_ini', '<=', $hoy)
                      ->where('fecha_fin', '>=', $hoy);
             })
             ->first();    

            if($conf) {
                $tip = auth()->user()->tipo;
                if($tip == 0) {
                    $ced = auth()->user()->cedula;
                    $alumno = Alumno::where('cedula', '=', $ced)->first();

                    // Obtener el último master al que se preinscribió el alumno
                    $preinscrito = Preinscrito::where('cedula', '=', $ced)     
                      ->orderByDesc('id')
                      ->first();

                      if ($preinscrito) {
                        // Buscar las materias aprobadas por el alumno en el master actual
                        $materias_aprobadas = Nota::select('plan_id')
                            ->where('alumno_id', '=', $alumno->id)
                            ->whereIn('plan_id', function ($query) use ($preinscrito) {
                              $query->select('id')
                                ->from('plans')
                                ->where('master_id', '=', $preinscrito->master_id);
                            })
                            ->where('nota_final', '>', 9)
                            ->get();
     
                       if ($materias_aprobadas->isNotEmpty()) {
                        // Obtener los códigos de las materias aprobadas por el alumno
                        $codigos_aprobados = Plan::whereIn('id', $materias_aprobadas->pluck('plan_id'))
                          ->pluck('codigo');

                        // Filtrar las materias permitidas para inscripción según las prelaciones
                        $materias_permitidas = Plan::where('master_id', $preinscrito->master_id)
                          ->whereNotIn('id', $materias_aprobadas->pluck('plan_id'))
                          ->where(function ($query) use ($codigos_aprobados) {
                             $query->whereNull('prelacion1')
                               ->orWhereIn('prelacion1', $codigos_aprobados)
                               ->WhereNull('prelacion2')
                               ->orWhereIn('prelacion2', $codigos_aprobados);
                          })
                          ->get();

                        } else {
                        // Ofrecer las materias del primer semestre
                         $materias_permitidas = Plan::where('master_id', $preinscrito->master_id)
                          ->where('semestre', 1)
                          ->get(); 
                         }
                        // Ahora busco las secciones disponibles de las materias permitidas
                        $secciones_disponibles = Infoseccion::select('infoseccions.id', 'infoseccions.nombre',
                        'infoseccions.periodo_id','plans.id as pid', 'plans.nombre as materia', 'plans.uc')
                           ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
                           ->where('infoseccions.activo', 1)
                           ->where('infoseccions.periodo_id', $periodo->id)
                           ->whereIn('infoseccions.plan_id', $materias_permitidas->pluck('id'))
                           ->orderBy('infoseccions.nombre', 'ASC')
                           ->get(); 

                        /////// busco la informacion faltante para pasar todos los props ///////////
                        // Nombre de la maestria o post //
                        $maestria = Master::select('masters.nombre')
                           ->where('id', $preinscrito->master_id)
                           ->first();

                        // busco si tiene materias inscritas en este periodo //
                        $insc = Inscripcion::select('inscripcions.id', 'inscripcions.alumno_id',
                        'inscripcions.infoseccion_id', 'infoseccions.nombre as seccion','plans.nombre as materia' )
                           ->join('infoseccions', 'infoseccions.id', '=', 'inscripcions.infoseccion_id')
                           ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
                           ->where('inscripcions.alumno_id', $alumno->id)
                           ->where('infoseccions.periodo_id', $periodo->id)
                           ->get(); 

                        // busco las uc pagadas y disponibles
                        $uc = PagoUc::where('cedula', $ced)
                              ->orderByDesc('id')
                              ->first();

                        if ($uc === null || $uc->uc_disponibles == 0) {
                            // Si no hay pago registrado, puedes asignar un valor predeterminado o un mensaje
                            $uc = ['mensaje' => 'No tiene UC disponibles'];
                        }      

                        return Inertia::render('Inscripcions/Create', ['alumno' => $alumno,
                        'secciones' => $secciones_disponibles, 'periodo' => $periodo, 'maestria' => $maestria,
                        'insc' => $insc, 'uc' => $uc ]);   

                    } else {
                     // esto nunca debe pasar
                     return Redirect::back()->with('message', 'Alumno no preinscrito en ningun postgrado');
                     }
                   
                /// si es un administrador ///
                } elseif($tip == 2) {  

                    $preinscritos = Preinscrito::select('preinscritos.id', 'preinscritos.cedula', 'preinscritos.master_id', 'preinscritos.updated_at', 'alumnos.nombre1', 
                    'alumnos.apellido1', 'masters.nombre')
                      ->join('alumnos', 'alumnos.cedula', '=', 'preinscritos.cedula')
                      ->join('masters', 'masters.id', '=', 'preinscritos.master_id')
                      ->orderBy('masters.nombre', 'ASC')
                      ->orderBy('alumnos.apellido1', 'ASC')
                      ->paginate(15);

                   return Inertia::render('Inscripcions/Index', ['preinscritos' => $preinscritos]);                   
                 }
            } else {
                return Redirect::back()->with('message', 'Inscripciones cerradas');
            }
        } else {
            return Redirect::back()->with('message', 'No hay un período activo');
        }
    }

    public function inscribir($cedula)
    {
       // Valido que las inscripciones esten abiertas para el periodo activo
 
        $hoy = now()->format('Y-m-d');
        // Busco el periodo activo (el ultimo porsi por error hay mas de uno)  
        $periodo = Periodo::select('id', 'nombre as nperiodo')
             ->where('activo', 1)
             ->orderByDesc('id')
             ->first();
        if($periodo){      
          $conf = ConfInscripcion::select('fecha_ini', 'fecha_fin')
             ->where('periodo_id', $periodo->id)
             ->where(function ($query) use ($hoy) {
                $query->where('fecha_ini', '<=', $hoy)
                      ->where('fecha_fin', '>=', $hoy);
             })
             ->first();    

            if($conf) {
                $alumno = Alumno::where('cedula', '=', $cedula)->first();

                // Obtengo el último master al que se preinscribió el alumno
                $preinscrito = Preinscrito::where('cedula', '=', $cedula)     
                      ->orderByDesc('id')
                      ->first();

                if ($preinscrito) {
                    // Busco las materias aprobadas por el alumno en el master actual
                    $materias_aprobadas = Nota::select('plan_id')
                        ->where('alumno_id', '=', $alumno->id)
                        ->whereIn('plan_id', function ($query) use ($preinscrito) {
                              $query->select('id')
                                ->from('plans')
                                ->where('master_id', '=', $preinscrito->master_id);
                            })
                        ->where('nota_final', '>', 9)
                        ->get();
     
                    if ($materias_aprobadas->isNotEmpty()) {
                      // Obtener los códigos de las materias aprobadas por el alumno
                        $codigos_aprobados = Plan::whereIn('id', $materias_aprobadas->pluck('plan_id'))
                          ->pluck('codigo');

                      // Filtrar las materias permitidas para inscripción según las prelaciones
                        $materias_permitidas = Plan::where('master_id', $preinscrito->master_id)
                          ->whereNotIn('id', $materias_aprobadas->pluck('plan_id'))
                          ->where(function ($query) use ($codigos_aprobados) {
                             $query->whereNull('prelacion1')
                               ->orWhereIn('prelacion1', $codigos_aprobados)
                               ->WhereNull('prelacion2')
                               ->orWhereIn('prelacion2', $codigos_aprobados);
                          })
                          ->get();

                        } else {
                        // Ofrecer las materias del primer semestre
                         $materias_permitidas = Plan::where('master_id', $preinscrito->master_id)
                            ->where('semestre', 1)
                            ->get(); 
                        }
                        // Ahora busco las secciones disponibles de las materias permitidas
                        $secciones_disponibles = Infoseccion::select('infoseccions.id', 'infoseccions.nombre',
                        'infoseccions.periodo_id','plans.id as pid', 'plans.nombre as materia', 'plans.uc')
                           ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
                           ->where('infoseccions.activo', 1)
                           ->where('infoseccions.periodo_id', $periodo->id)
                           ->whereIn('infoseccions.plan_id', $materias_permitidas->pluck('id'))
                           ->orderBy('infoseccions.nombre', 'ASC')
                           ->get(); 

                        /////// busco la informacion faltante para pasar todos los props ///////////
                        // Nombre de la maestria o post //
                        $maestria = Master::select('masters.nombre')
                           ->where('id', $preinscrito->master_id)
                           ->first();

                        // busco si tiene materias inscritas en este periodo //
                        $insc = Inscripcion::select('inscripcions.id', 'inscripcions.alumno_id',
                        'inscripcions.infoseccion_id', 'infoseccions.nombre as seccion','plans.nombre as materia' )
                           ->join('infoseccions', 'infoseccions.id', '=', 'inscripcions.infoseccion_id')
                           ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
                           ->where('inscripcions.alumno_id', $alumno->id)
                           ->where('infoseccions.periodo_id', $periodo->id)
                           ->get(); 

                        // busco las uc pagadas y disponibles
                        $uc = PagoUc::where('cedula', $cedula)
                              ->orderByDesc('id')
                              ->first();

                        if ($uc === null || $uc->uc_disponibles == 0) {
                            // Si no hay pago registrado, puedes asignar un valor predeterminado o un mensaje
                            $uc = ['mensaje' => 'No tiene UC disponibles'];
                        }      

                        return Inertia::render('Inscripcions/Create', ['alumno' => $alumno,
                        'secciones' => $secciones_disponibles, 'periodo' => $periodo, 'maestria' => $maestria,
                        'insc' => $insc, 'uc' => $uc ]);   

                    } else {
                     // esto nunca debe pasar
                     return Redirect::back()->with('message', 'Alumno no preinscrito en ningun postgrado');
                     }               
            } else {
                return Redirect::back()->with('message', 'Inscripciones cerradas');
            }
        } else {
            return Redirect::back()->with('message', 'No hay un período activo');
        }        
       
    }

    public function store(Request $request)
    {   
        $request->validate([
            'alumno_id' => 'required',
            'infoseccion_id' => 'required',             
        ]);
        // ahora debo validar la cantidad de UCs disponibles del alumno Vs la cantidad de UCs de la materia

        // primero busco la cantidad de UC de esa materia
        $cant_uc = Infoseccion::select('infoseccions.plan_id', 'plans.uc as uc')
                ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
                ->where('infoseccions.id', $request->infoseccion_id)
                ->first();

        // busco si no ha agregado esta misma materia en este periodo 
        $validar_mat = Inscripcion::select('inscripcions.infoseccion_id', 'infoseccions.id','infoseccions.plan_id')
                ->join('infoseccions', 'infoseccions.id', '=', 'inscripcions.infoseccion_id')
                ->where('inscripcions.alumno_id', $request->alumno_id)
                ->where('infoseccions.plan_id', $cant_uc->plan_id)
                ->where('infoseccions.periodo_id', $request->periodo_id)
                ->first();
        
        if($validar_mat){
            return Redirect::back()->with('message', 'La materia ya está inscrita, seleccione otra');
        } 
        else {  

          // busco las uc pagadas y disponibles
          $alumno = Alumno::where('id', '=', $request->alumno_id)->first();
          $pago_uc = PagoUc::where('cedula', $alumno->cedula)
           ->orderByDesc('id')
           ->first();

         if ($pago_uc === null || $pago_uc->uc_disponibles == 0) {     
            return Redirect::back()->with('message', 'No ha realizado el pago de UC');
         } else { 
            if($pago_uc->uc_disponibles >= $cant_uc->uc) {   
             
              $inscripcion = Inscripcion::create([
                'alumno_id' => $request->alumno_id,
                'infoseccion_id' => $request->infoseccion_id,            
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,         
              ]);
              $inscripcion->save();
              // ahora debo restar las UCs disponibles del alumno
              $pago_uc->update([
                'uc_disponibles' => $pago_uc->uc_disponibles - $cant_uc->uc,
              ]);
              $pago_uc->save();
              // ahora resto el cupo de la seccion
              $infoseccion = Infoseccion::where('id', $request->infoseccion_id)->first(); 
              $infoseccion->update([
                  'cupo' => $infoseccion->cupo-1,
              ]);
              $infoseccion->save();
              return Redirect::back()->with('message', 'Materia agregada satisfactoriamente');
            } else {
                return Redirect::back()->with('message', 'No dispone de suficientes UCs para agregar la materia');
            }
          }
        }
    }

    public function update(Request $request, Inscripcion $inscripcion)
    {
        $request->validate([
            'alumno_id' => 'required',
            'infoseccion_id' => 'required',             
        ]);
        // ahora debo validar la cantidad de UCs disponibles del alumno Vs la cantidad de UCs de la materia
        // primero debo saber la cantidad de UC de la materia que estoy modificando y obtengo el 
        // infoseccion_id de la seccion vieja
        $cant_uc_old = Inscripcion::select('inscripcions.id', 'inscripcions.infoseccion_id', 'infoseccions.plan_id', 'plans.uc as old_uc')
                ->join('infoseccions', 'infoseccions.id', '=', 'inscripcions.infoseccion_id')
                ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
                ->where('inscripcions.id', $inscripcion->id)
                ->first();

        // ahora busco la cantidad de UC de la materia que voy a reemplazar
        $cant_uc = Infoseccion::select('infoseccions.plan_id', 'plans.uc as uc')
                ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
                ->where('infoseccions.id', $request->infoseccion_id)
                ->first();

         
        // busco las uc pagadas y disponibles
        $alumno = Alumno::where('id', '=', $request->alumno_id)->first();
        $pago_uc = PagoUc::where('cedula', $alumno->cedula)
              ->orderByDesc('id')
              ->first();        


        // Voy a validar que la seccion que quiero modificar no tenga nota aun 
        $validar_mat = Inscripcion::select('inscripcions.infoseccion_id', 'notas.nota_final')
                ->join('notas', 'notas.infoseccion_id', '=', 'inscripcions.infoseccion_id')
                ->where('inscripcions.alumno_id', $request->alumno_id)
                ->where('notas.infoseccion_id', $cant_uc_old->infoseccion_id)
                ->first();
        if($validar_mat){
            return Redirect::back()->with('message', 'La materia que desea cambiar ya tiene nota, no puede cambiarla');
        } 
        else {      

          $puede = 0; $dif = 0;
          // Valido si la cantidad de UC de la materia nueva es mayor a la cantidad de UC de la materia vieja
          // valido si no tengo suficientes UC para hacer el cambio
          if($cant_uc->uc > $cant_uc_old->old_uc) {
             $dif = $cant_uc->uc - $cant_uc_old->old_uc;
             
            // si no dispone de esta cantidad de UC lo saco         
            if($pago_uc->uc_disponibles < $dif) {
                return Redirect::back()->with('message', 'No dispone de mas UC para realizar el cambio');
            } else {
                // si es mayor pero si tiene mas UCs disponibles
                $puede = 1;
            }
          } else { // si tiene la misma cantidad de uc o menos o si tiene mas saldo de uc
            if($cant_uc->uc <= $cant_uc_old->old_uc || $puede == 1) {
                // aqui hago todo
                $inscripcion->update([
                    'infoseccion_id' => $request->infoseccion_id,
                    'updated_by' => auth()->user()->id,
                  ]);
                $inscripcion->save();
                $pago_uc->update([
                    'uc_disponibles' => $pago_uc->uc_disponibles - $dif,
                ]);
                $pago_uc->save();  
                // ahora resto el cupo de la seccion nueva
                $infoseccion = Infoseccion::where('id', $request->infoseccion_id)->first(); 
                $infoseccion->update([
                  'cupo' => $infoseccion->cupo-1,
                ]);
                $infoseccion->save();
                // y sumo el cupo de la seccion vieja $cant_uc_old->infoseccion_id
                $infoseccion2 = Infoseccion::where('id', $cant_uc_old->infoseccion_id)->first(); 
                $infoseccion2->update([
                    'cupo' => $infoseccion->cupo+1,
                  ]);
                  $infoseccion2->save();
                return Redirect::back()->with('message', 'Materia modificada satisfactoriamente');

             }
           }          
        } //validar si la materia tienen nota
    }

    public function destroy(Inscripcion $inscripcion)
    {
        // busco el infoseccion_id de la seccion vieja
        $infoseccion = Inscripcion::select('inscripcions.infoseccion_id')
                ->join('infoseccions', 'infoseccions.id', '=', 'inscripcions.infoseccion_id')
                ->where('inscripcions.id', $inscripcion->id)
                ->first();
        // valido que no tenga nota antes de eliminarla
        $validar_mat = Inscripcion::select('inscripcions.infoseccion_id', 'notas.nota_final')
                ->join('notas', 'notas.infoseccion_id', '=', 'inscripcions.infoseccion_id')
                ->where('inscripcions.alumno_id', $inscripcion->alumno_id)
                ->where('notas.infoseccion_id', $infoseccion->infoseccion_id)
                ->first();
        if($validar_mat){
            return Redirect::back()->with('message', 'La materia que desea eliminar ya tiene nota, no puede eliminarla');
        } 
        else {
            // sumo cupo a la seccion 
            $infoseccion2 = Infoseccion::where('id', $infoseccion->infoseccion_id)->first(); 
            $infoseccion2->update([
                'cupo' => $infoseccion->cupo+1,
            ]);
            $infoseccion2->save();
            $inscripcion->delete();
            return Redirect::back()->with('message', 'La materia ha sido eliminada');
        }
    }
}
