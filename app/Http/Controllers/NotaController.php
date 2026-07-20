<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Infoseccion;
use App\Models\Plan;
use App\Models\Periodo;
use App\Models\Docente;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\DB;
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

        // ==========================================
        // NUEVO FLUJO: Alumno (tipo == 0)
        // ==========================================
        if ($tip == 0) {
            $cedula = auth()->user()->cedula;

            // Buscamos los datos básicos del alumno logueado
            $alumno = DB::table('alumnos')
                ->select('id', 'cedula', DB::raw("CONCAT(nombre1, ' ', apellido1) as nombre_completo"))
                ->where('cedula', $cedula)
                ->first();

            if (!$alumno) {
                return redirect('dashboard')->with('message', 'No se encontraron sus datos de alumno en el sistema');
            }

            // Consultamos las materias inscritas en el período activo cruzando con sus notas (si existen)
            $calificaciones = DB::table('inscripcions')
                ->join('infoseccions', 'infoseccions.id', '=', 'inscripcions.infoseccion_id')
                ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
                ->leftJoin('notas', function ($join) use ($alumno) {
                    $join->on('notas.infoseccion_id', '=', 'inscripcions.infoseccion_id')
                        ->where('notas.alumno_id', '=', $alumno->id);
                })
                ->select(
                    'infoseccions.id as seccion_id',
                    'infoseccions.nombre as nombre_seccion',
                    'infoseccions.modalidad',
                    'plans.nombre as nombre_materia',
                    'plans.uc',
                    'notas.nota_final' // Puede ser NULL si el docente no la ha cargado
                )
                ->where('inscripcions.alumno_id', $alumno->id)
                ->where('infoseccions.periodo_id', $periodo->id)
                ->orderBy('plans.nombre', 'ASC')
                ->get();

            // Renderizamos la nueva vista dedicada para los alumnos
            return Inertia::render('Notas/MisCalificaciones', [
                'periodo'        => $periodo,
                'alumno'         => $alumno,
                'calificaciones' => $calificaciones
            ]);
        }

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

    public function reporteImprimir($seccion)
    {
        $tip = auth()->user()->tipo;
        // Solo permitimos el acceso al administrador (tipo 2)
        if ($tip !== 2) {
            return redirect('dashboard')->with('message', 'No tiene acceso a este reporte administrativo');
        }

        // Buscamos los datos del encabezado, sección, período y docente
        $infoseccion = Infoseccion::select('infoseccions.id', 'infoseccions.nombre', 'infoseccions.docente_id',
            'infoseccions.modalidad', 'infoseccions.periodo_id', 'plans.nombre as pnombre', 'masters.nombre as nombre_maestria')
                ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
                ->join('masters', 'masters.id', '=', 'plans.master_id')
                ->where('infoseccions.id', $seccion)
                ->firstOrFail();

        $periodo = Periodo::select('id', 'nombre')->where('id', $infoseccion->periodo_id)->first();
        $docente = Docente::select('id', 'cedula', 'nombre')->where('id', $infoseccion->docente_id)->first();

        // Buscamos los alumnos inscritos ordenados alfabéticamente
        $inscritos = Inscripcion::select('inscripcions.alumno_id', 'inscripcions.infoseccion_id',
            'alumnos.cedula', 'alumnos.nombre1', 'alumnos.nombre2', 'alumnos.apellido1', 'alumnos.apellido2')
        ->join('infoseccions', 'infoseccions.id', '=', 'inscripcions.infoseccion_id')
        ->join('alumnos', 'alumnos.id', '=', 'inscripcions.alumno_id')
        ->where('inscripcions.infoseccion_id', $infoseccion->id)
        ->orderBy('alumnos.apellido1', 'ASC')
        ->orderBy('alumnos.nombre1', 'ASC')
        ->get();

        $list = array();
        $i = 0;

        foreach ($inscritos as $item) {
            $nota = Nota::select('nota_final')
                ->where('alumno_id', $item->alumno_id)
                ->where('infoseccion_id', $item->infoseccion_id)
                ->first();

            // Si no tiene nota o es 0, lo tratamos como pendiente en el acta física
            $nota_final = !$nota ? null : $nota->nota_final;

            $i++;
            $list[] = [
                'num'       => $i,
                'cedula'    => $item->cedula,
                'nombre'    => "{$item->apellido1} {$item->apellido2}, {$item->nombre1} {$item->nombre2}",
                'nota'      => $nota_final
            ];
        }

        return Inertia::render('Reportes/SeccionImprimir', [
            'periodo'     => $periodo,
            'docente'     => $docente,
            'infoseccion' => $infoseccion,
            'inscritos'   => $list
        ]);
    }

    public function destroy(Nota $nota)
    {
        //
    }
}
