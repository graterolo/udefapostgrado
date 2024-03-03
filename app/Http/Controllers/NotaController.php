<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Infoseccion;
use App\Models\Plan;
use App\Models\Periodo;
use App\Models\Docente;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NotaController extends Controller
{

    public function index()
    {
        // Busco el periodo activo (el ultimo porsi por error hay mas de uno)  
        $periodo = Periodo::select('id', 'nombre')
             ->where('activo', 1)
             ->orderByDesc('id')
             ->first();
        
        $tip = auth()->user()->tipo;
        if($tip == 1) {
            // si es docente busco los datos y las secciones que tiene en este periodo
            $cedula = auth()->user()->cedula;
            $docente = Docente::select('id', 'cedula', 'nombre')
             ->where('cedula', $cedula)
             ->first();
            
            $infoseccions = Infoseccion::select('infoseccions.id', 'infoseccions.nombre', 'infoseccions.modalidad', 
             'plans.nombre as pnombre')
                 ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
                 ->where('infoseccions.activo', '=', 1)
                 ->where('infoseccions.periodo_id', '=', $periodo->id)
                 ->where('infoseccions.docente_id', $docente->id)
                 ->get();
            
            // Voy al index con esta informacion 
            return Inertia::render('Notas/Index', ['periodo' => $periodo, 'docente' => $docente, 
            'infoseccions' => $infoseccions ]);

        } elseif($tip == 2) {
            // busco a los docentes que tengan carga academica en este periodo
            $docentes = Docente::select('docentes.id', 'docentes.nombre', 'docentes.cedula')
                ->join('infoseccions', 'infoseccions.docente_id', '=', 'docentes.id')
                ->where('infoseccions.activo', '=', 1)
                ->where('infoseccions.periodo_id', '=', $periodo->id)
                ->groupBy('docentes.id', 'docentes.nombre', 'docentes.cedula')
                ->paginate(15);

            return Inertia::render('Notas/Calificaciones', ['periodo' => $periodo, 'docentes' => $docentes]);
            
        } else {
            return redirect('dashboard')->with('message', 'No tiene acceso a este modulo');
        }
    }

    public function calificaciones($cedula)
    {
        // Busco el periodo activo (el ultimo porsi por error hay mas de uno)  
        $periodo = Periodo::select('id', 'nombre')
             ->where('activo', 1)
             ->orderByDesc('id')
             ->first();
        
            // busco los datos del docente y las secciones que tiene en este periodo
            $docente = Docente::select('id', 'cedula', 'nombre')
             ->where('cedula', $cedula)
             ->first();
            
            $infoseccions = Infoseccion::select('infoseccions.id', 'infoseccions.nombre', 'infoseccions.modalidad', 
             'plans.nombre as pnombre')
                 ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
                 ->where('infoseccions.activo', '=', 1)
                 ->where('infoseccions.periodo_id', '=', $periodo->id)
                 ->where('infoseccions.docente_id', $docente->id)
                 ->get();
            //dd($infoseccions);
            // Voy al index con esta informacion 
            return Inertia::render('Notas/Index', ['periodo' => $periodo, 'docente' => $docente, 
            'infoseccions' => $infoseccions ]);
    }

    public function calificacion($seccion)
    { 
      $tip = auth()->user()->tipo;
      if($tip >= 1) {  
        // voy a buscar a los datos del encabezado, seccion, periodo y docente 
        // busco los datos de la seccion
        $infoseccion = Infoseccion::select('infoseccions.id', 'infoseccions.nombre', 'infoseccions.docente_id',
        'infoseccions.modalidad', 'infoseccions.periodo_id', 'plans.nombre as pnombre')
                 ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
                 ->where('infoseccions.id', $seccion)
                 ->first();

        // Busco los datos del periodo de la seccion  
        $periodo = Periodo::select('id', 'nombre')
            ->where('id', $infoseccion->periodo_id)
            ->first();

        // busco los datos del docente y las secciones que tiene en este periodo
        $docente = Docente::select('id', 'cedula', 'nombre')
             ->where('id', $infoseccion->docente_id)
             ->first();
        

        // Busco los alumnos inscritos en esta seccion
        $inscritos = Inscripcion::select('inscripcions.id', 'inscripcions.alumno_id', 'inscripcions.infoseccion_id', 
        'alumnos.cedula', 'alumnos.nombre1', 'alumnos.nombre2', 'alumnos.apellido1', 'alumnos.apellido2',
        'infoseccions.plan_id')
           ->join('infoseccions', 'infoseccions.id', '=', 'inscripcions.infoseccion_id')
           ->join('alumnos', 'alumnos.id', '=', 'inscripcions.alumno_id')
           ->where('inscripcions.infoseccion_id', $infoseccion->id)
           ->get();
        // creo el array donde voy a guardar toda la informacion
        $list=array(); $i=0;
        // voy a recorrer la coleccion de inscritos para buscar la nota si la tiene e insertar en el array
        foreach ($inscritos as $item) {
            $nota = Nota::select('nota_final')
                ->where('alumno_id', $item->alumno_id)
                ->where('infoseccion_id', $item->infoseccion_id)
                ->first();
            if(!$nota) {
                $nota_final = 0;
            } else {
                $nota_final = $nota->nota_final;
            }
            $i++;
            // guardo la informacion en el array
            $id=$i;
            $list[$id]["id"]=$id;
            $list[$id]["alumno_id"]=$item->alumno_id;
            $list[$id]["infoseccion_id"]=$item->infoseccion_id;
            $list[$id]["cedula"]=$item->cedula;
            $list[$id]["nombre1"]=$item->nombre1;
            $list[$id]["nombre2"]=$item->nombre2;
            $list[$id]["apellido1"]=$item->apellido1;
            $list[$id]["apellido2"]=$item->apellido2;
            $list[$id]["plan_id"]=$item->plan_id;
            $list[$id]["nota"]=$nota_final;
        }
       //dd($list);
        return Inertia::render('Notas/Create', ['periodo' => $periodo, 'docente' => $docente, 
            'infoseccion' => $infoseccion, 'inscritos' => $list ]); 
           
      } else {
        return redirect('dashboard')->with('message', 'No tiene acceso a este modulo');
    }    
        
    }

    public function store(Request $request)
    {   
        // Obtengo los datos enviados desde la vista
        $data = $request->input('data');
       
        // Recorro el array de los inscritos en esa seccion
        foreach ($data as $item ) {
            // Accedo a los campos de cada registro
            $alumnoId = $item['alumno_id'];
            $infoseccionId = $item['infoseccion_id'];
            $planId = $item['plan_id'];
            $nota = $item['nota'];
            // voy a buscar si existe en la tabla notas, si existe actualizo, sino inserto
            $bnota = Nota::select('id')
             ->where('alumno_id', $alumnoId)
             ->where('infoseccion_id', $infoseccionId)
             ->first();
            
            // Existe
             if ($bnota) {
                $bnota->update([
                    'nota_final' => $nota,
                    'updated_by' => auth()->user()->id,     
              ]);
              $bnota->save();
             } else {
                $nota = Nota::create([
                    'alumno_id' => $alumnoId,
                    'plan_id' => $planId,
                    'infoseccion_id' => $infoseccionId,
                    'nota_final' => $nota,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,     
                ]);
                $nota->save();
             }

        }
        return redirect('notas')->with('message', 'Notas guardadas con éxito');
    
    }
 
    public function destroy(Nota $nota)
    {
        //
    }
}
