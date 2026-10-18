<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Infoseccion;
use App\Models\Plan;
use App\Models\Periodo;
use App\Models\Docente;
use App\Models\Inscripcion;
use App\Models\Alumno;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NotaController extends Controller
{

    public function index(Request $request)
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
                //->where('infoseccions.periodo_id', $periodo->id)
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
            // 1. Obtenemos todos los periodos para poblar el dropdown del filtro en Vue
            $periodos = Periodo::select('id', 'nombre')->orderByDesc('id')->get();
            // 2. Capturamos el periodo_id que viene por Request, si no viene, usamos el activo por defecto
            $periodoSeleccionadoId = $request->input('periodo_id', $periodo->id);

            // Obtenemos el objeto del periodo actual para la vista (por si cambió en el filtro)
            $periodoVista = Periodo::find($periodoSeleccionadoId);


            // 3. busco a los docentes que tengan carga academica en este periodo
            $docentes = Docente::select('docentes.id', 'docentes.nombre', 'docentes.cedula')
                ->join('infoseccions', 'infoseccions.docente_id', '=', 'docentes.id')
                ->where('infoseccions.activo', '=', 1)
                ->where('infoseccions.periodo_id', '=', $periodoSeleccionadoId) // Filtro dinámico
                ->groupBy('docentes.id', 'docentes.nombre', 'docentes.cedula')
                ->paginate(15)
                ->withQueryString(); // Mantiene el parámetro de paginación junto al filtro

            return Inertia::render('Notas/Calificaciones', [
                'periodo' => $periodoVista,
                'periodos' => $periodos, // Enviamos la lista completa de periodos
                'docentes' => $docentes
            ]);


        } else {
            return redirect('dashboard')->with('message', 'No tiene acceso a este modulo');
        }
    }

    public function calificaciones(Request $request, $cedula)
    { //dd($cedula);
        // 1. Buscamos el periodo activo por defecto
        $periodoActivo = Periodo::select('id', 'nombre')->where('activo', 1)->orderByDesc('id')->first();

        // 2. Si viene un periodo_id en la URL (desde el filtro del index), usamos ese. Si no, el activo.
        $periodoId = $request->input('periodo_id', $periodoActivo->id);

        $periodo = Periodo::find($periodoId);
        //dd($periodo->id);
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

    public function indexAlumnosAdmin(Request $request)
    {
        if (auth()->user()->tipo !== 2) {
            return redirect('dashboard')->with('message', 'No autorizado');
        }

        // 1. Selector de períodos
        $periodos = Periodo::select('id', 'nombre')->orderByDesc('id')->get();
        $periodoActivo = Periodo::where('activo', 1)->orderByDesc('id')->first();
        $periodoSeleccionadoId = $request->input('periodo_id', $periodoActivo->id);
        $periodoVista = Periodo::find($periodoSeleccionadoId);

        // 2. Consultamos los alumnos con carga académica en este período
        $alumnos = Alumno::select(
                'alumnos.id',
                'alumnos.cedula',
                DB::raw("CONCAT(alumnos.apellido1, ' ', alumnos.nombre1) as nombre_completo"),
                DB::raw("COUNT(inscripcions.id) as materias_inscritas")
            )
            ->join('inscripcions', 'inscripcions.alumno_id', '=', 'alumnos.id')
            ->join('infoseccions', 'infoseccions.id', '=', 'inscripcions.infoseccion_id')
            ->where('infoseccions.periodo_id', $periodoSeleccionadoId)
            ->groupBy('alumnos.id', 'alumnos.cedula', 'alumnos.apellido1', 'alumnos.nombre1')
            ->paginate(15)
            ->withQueryString();

        return Inertia::render('Notas/AlumnosAdmin', [
            'periodo' => $periodoVista,
            'periodos' => $periodos,
            'alumnos' => $alumnos
        ]);
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

    public function historialPorCedula(Request $request)
    {
        $tip = auth()->user()->tipo;
        if ($tip !== 2) {
            return redirect('dashboard')->with('message', 'No tiene acceso a este módulo');
        }

        $cedula = $request->input('cedula');
        if (!$cedula) {
            return Inertia::render('Reportes/BuscarHistorial'); // Pantalla inicial para ingresar cédula
        }

        // Buscamos los datos básicos del alumno
        $alumno = DB::table('alumnos')
            ->select('id', 'cedula', DB::raw("CONCAT(nombre1, ' ', apellido1) as nombre_completo"))
            ->where('cedula', $cedula)
            ->first();

        if (!$alumno) {
            return back()->with('message', 'No se encontraron registros para la cédula ingresada.');
        }

        // Traemos TODAS las calificaciones (Historial) eliminando la restricción de periodo_id
        $calificaciones = DB::table('inscripcions')
            ->join('infoseccions', 'infoseccions.id', '=', 'inscripcions.infoseccion_id')
            ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
            ->join('periodos', 'periodos.id', '=', 'infoseccions.periodo_id') // Añadimos periodo para agrupar en la vista si deseas
            ->leftJoin('notas', function ($join) use ($alumno) {
                $join->on('notas.infoseccion_id', '=', 'inscripcions.infoseccion_id')
                    ->where('notas.alumno_id', '=', $alumno->id);
            })
            ->select(
                'infoseccions.id as seccion_id',
                'infoseccions.nombre as nombre_seccion',
                'plans.nombre as nombre_materia',
                'plans.uc',
                'periodos.nombre as nombre_periodo',
                'notas.nota_final'
            )
            ->where('inscripcions.alumno_id', $alumno->id)
            ->orderBy('periodos.id', 'DESC')
            ->orderBy('plans.nombre', 'ASC')
            ->get();

        return Inertia::render('Reportes/HistorialAlumno', [
            'alumno' => $alumno,
            'calificaciones' => $calificaciones
        ]);
    }

    public function constanciaEstudios(Request $request)
    {
        $tip = auth()->user()->tipo;
        if ($tip !== 2) {
            return redirect('dashboard')->with('message', 'No tiene acceso a reportes');
        }

        $cedula = $request->input('cedula');
        if (!$cedula) {
            return Inertia::render('Reportes/BuscarConstancia');
        }

        // 1. Buscamos el periodo activo actual
        $periodoActivo = Periodo::where('activo', 1)->orderByDesc('id')->first();

        // 2. Validamos al alumno
        $alumno = DB::table('alumnos')
            ->select('id', 'cedula', DB::raw("CONCAT(nombre1, ' ', nombre2, ' ', apellido1, ' ', apellido2) as nombre_completo"))
            ->where('cedula', $cedula)
            ->first();

        if (!$alumno) {
            return back()->with('message', 'Alumno no encontrado.');
        }

        // 3. Verificamos si tiene inscripciones en el periodo activo y jalamos los datos de la Maestría
        $inscripcionActiva = Inscripcion::join('infoseccions', 'infoseccions.id', '=', 'inscripcions.infoseccion_id')
            ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
            ->join('masters', 'masters.id', '=', 'plans.master_id')
            ->select('masters.nombre as nombre_maestria')
            ->where('inscripcions.alumno_id', $alumno->id)
            ->where('infoseccions.periodo_id', $periodoActivo->id)
            ->first(); // Con que tenga al menos una materia inscrita basta

        if (!$inscripcionActiva) {
            return back()->with('message', 'El alumno no posee una inscripción activa en el periodo actual.');
        }

        return Inertia::render('Reportes/ConstanciaImprimir', [
            'alumno' => $alumno,
            'maestria' => $inscripcionActiva->nombre_maestria,
            'periodo' => $periodoActivo,
            'fecha_emision' => date('d/m/Y')
        ]);
    }

    public function reporteAsistencia($seccion)
    {
        $tip = auth()->user()->tipo;
        if ($tip !== 2) {
            return redirect('dashboard')->with('message', 'No autorizado');
        }

        $infoseccion = Infoseccion::select('infoseccions.id', 'infoseccions.nombre', 'infoseccions.docente_id',
            'infoseccions.modalidad', 'infoseccions.periodo_id', 'plans.nombre as pnombre', 'masters.nombre as nombre_maestria')
                ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
                ->join('masters', 'masters.id', '=', 'plans.master_id')
                ->where('infoseccions.id', $seccion)
                ->firstOrFail();

        $periodo = Periodo::select('id', 'nombre')->where('id', $infoseccion->periodo_id)->first();
        $docente = Docente::select('id', 'cedula', 'nombre')->where('id', $infoseccion->docente_id)->first();

        $inscritos = Inscripcion::select('alumnos.cedula', 'alumnos.nombre1', 'alumnos.nombre2', 'alumnos.apellido1', 'alumnos.apellido2')
            ->join('alumnos', 'alumnos.id', '=', 'inscripcions.alumno_id')
            ->where('inscripcions.infoseccion_id', $infoseccion->id)
            ->orderBy('alumnos.apellido1', 'ASC')
            ->orderBy('alumnos.nombre1', 'ASC')
            ->get();

        $list = [];
        foreach ($inscritos as $index => $item) {
            $list[] = [
                'num'    => $index + 1,
                'cedula' => $item->cedula,
                'nombre' => "{$item->apellido1} {$item->apellido2}, {$item->nombre1} {$item->nombre2}",
            ];
        }

        return Inertia::render('Reportes/AsistenciaImprimir', [
            'periodo'     => $periodo,
            'docente'     => $docente,
            'infoseccion' => $infoseccion,
            'inscritos'   => $list
        ]);
    }

    public function imprimirHistorialAlumno(Request $request, $cedula)
    {
        if (auth()->user()->tipo !== 2) {
            return redirect('dashboard')->with('message', 'No tiene acceso a reportes administrativos');
        }

        // 1. Buscamos los datos básicos del alumno
        $alumno = DB::table('alumnos')
            ->select('id', 'cedula', DB::raw("CONCAT(nombre1, ' ', nombre2, ' ', apellido1, ' ', apellido2) as nombre_completo"))
            ->where('cedula', $cedula)
            ->first();

        // 2. Buscamos TODAS las maestrías en las que el alumno se ha inscrito alguna vez
        $maestriasDelAlumno = Inscripcion::join('infoseccions', 'infoseccions.id', '=', 'inscripcions.infoseccion_id')
            ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
            ->join('masters', 'masters.id', '=', 'plans.master_id')
            ->select('masters.id', 'masters.nombre')
            ->where('inscripcions.alumno_id', $alumno->id)
            ->groupBy('masters.id', 'masters.nombre')
            ->get();

        if ($maestriasDelAlumno->isEmpty()) {
            return back()->with('message', 'El alumno no posee ninguna inscripción registrada.');
        }

        // 3. Determinamos cuál maestría mostrar: la que el admin elija por filtro, o la última por defecto
        // (Tomamos la última de la colección si no viene un parámetro explícito)
        $masterId = $request->input('master_id', $maestriasDelAlumno->last()->id);

        // Obtenemos el objeto específico de la maestría seleccionada
        $maestriaSeleccionada = $maestriasDelAlumno->firstWhere('id', $masterId);

        // 4. Consultamos las calificaciones FILTRANDO ESTRICTAMENTE por la maestría seleccionada
        $calificaciones = DB::table('inscripcions')
            ->join('infoseccions', 'infoseccions.id', '=', 'inscripcions.infoseccion_id')
            ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
            ->join('periodos', 'periodos.id', '=', 'infoseccions.periodo_id')
            ->leftJoin('notas', function ($join) use ($alumno) {
                $join->on('notas.infoseccion_id', '=', 'inscripcions.infoseccion_id')
                    ->where('notas.alumno_id', '=', $alumno->id);
            })
            ->select(
                'periodos.nombre as nombre_periodo',
                'plans.nombre as nombre_materia',
                'plans.uc',
                'infoseccions.nombre as nombre_seccion',
                'notas.nota_final'
            )
            ->where('inscripcions.alumno_id', $alumno->id)
            ->where('plans.master_id', $masterId) // <-- ¡EL FILTRO CRUCIAL! Evita la mezcla de materias
            ->orderBy('periodos.id', 'ASC')
            ->orderBy('plans.nombre', 'ASC')
            ->get();

        return Inertia::render('Reportes/HistorialImprimir', [
            'alumno'             => $alumno,
            'maestria'           => $maestriaSeleccionada->nombre,
            'maestria_id'        => $maestriaSeleccionada->id,
            'todas_maestrias'    => $maestriasDelAlumno, // Se las pasamos a Vue por si hay más de una
            'calificaciones'     => $calificaciones
        ]);

    }

    public function destroy(Nota $nota)
    {
        //
    }
}
