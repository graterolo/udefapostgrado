<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Validation\Rule;
use App\Models\Infoseccion;
use App\Models\Dia;
use App\Models\Plan;
use App\Models\Periodo;
use App\Models\Docente;
use App\Models\Inscripcion;
use App\Models\Aula;
use App\Models\Hora;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;


class InfoseccionController extends Controller
{

    public function index()
    {
        $tip = auth()->user()->tipo;
        if($tip == 2) {  
           $infoseccions = Infoseccion::select('infoseccions.id', 'infoseccions.nombre', 'infoseccions.modalidad', 
           'infoseccions.cupo', 'infoseccions.activo', 'periodos.nombre as pnombre')
             ->join('periodos', 'periodos.id', '=', 'infoseccions.periodo_id')
             ->orderByDesc('periodos.nombre')
             ->orderBy('infoseccions.nombre', 'ASC')
             ->paginate(20);

             return Inertia::render('Infoseccions/Index', ['infoseccions' => $infoseccions]);

        } else {
            return redirect('dashboard')->with('message', 'No tiene acceso a este modulo');
        }
    }

    public function create()
    {
        $plans = Plan::select('id', 'codigo', 'nombre')->orderBy('codigo', 'ASC')->get();
        $periodos = Periodo::select('id', 'nombre')
            ->orderByDesc('id')
            ->limit(2)
            ->get();
        $docentes = Docente::select('id', 'nombre')->get();
           
        return Inertia::render('Infoseccions/Create', [
            'plans' => $plans, 'periodos' => $periodos, 'docentes' => $docentes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required',
            'periodo_id' => 'required',
            'docente_id' => 'required',
            'modalidad' => 'required',
            'cupo' => 'required', 
            'activo' => 'required',  
        ]);
        $periodo = Periodo::select('id')->where('activo', '=', 1)->orderBy('id', 'DESC')->first();  
        if($periodo) { 
            $codigo = Plan::select('codigo')->where('id', '=', $request->plan_id)->first();
            $mat = $codigo->codigo; 
            $sec = Infoseccion::select('nombre')->where('periodo_id', '=', $periodo->id)
                   ->where('nombre', 'LIKE', "%{$mat}%" )
                   ->orderBy('id', 'DESC')
                   ->first();

            if(!$sec) {
                $seccion = $codigo->codigo.'01';
            } else {
                $count=substr($sec->nombre, 6,8)+1;
                if($count < 10) 
                  $seccion = $codigo->codigo.'0'.$count;
                else
                  $seccion = $codigo->codigo.$count;               
            }         

          $infoseccion = Infoseccion::create([
              'plan_id' => $request->plan_id,
              'periodo_id' => $periodo->id,
              'nombre' => $seccion,
              'docente_id' => $request->docente_id,
              'modalidad' => $request->modalidad,
              'cupo' => $request->cupo,            
              'activo' => $request->activo,
              'created_by' => auth()->user()->id,
              'updated_by' => auth()->user()->id,

          ]);

          $infoseccion->save();
          return redirect('infoseccions')->with('message', 'La sección se ha creado satisfactoriamente');
        } else {
            return Redirect::back()->with('message', 'No hay un período activo para crear la sección, debe activar el período');
        }
    }

    public function show(Infoseccion $infoseccion)
    {
        $id = $infoseccion->id;
        $infoseccion = Infoseccion::select('infoseccions.id', 'infoseccions.nombre', 'infoseccions.modalidad', 
        'infoseccions.cupo', 'infoseccions.activo', 'infoseccions.updated_at', 'infoseccions.updated_by', 
        'docentes.nombre as dnombre', 'periodos.nombre as pnombre', 'plans.nombre as panombre', 'users.name as name')
          ->join('periodos', 'periodos.id', '=', 'infoseccions.periodo_id')
          ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
          ->join('docentes', 'docentes.id', '=', 'infoseccions.docente_id')
          ->join('users', 'users.id', '=', 'infoseccions.updated_by')
          ->where('infoseccions.id', '=', $id)
          ->first();

        $dias = Dia::select('dias.id', 'dias.infoseccion_id', 'dias.ndia', 'dias.hora_ent', 'dias.hora_sal',
        'dias.aula_id','aulas.codigo')
            ->join('aulas', 'aulas.id', '=', 'dias.aula_id')
            ->where('dias.infoseccion_id', '=', $id)
            ->get();

        $aulas = Aula::get();
        $horas = Hora::get();
       
        return Inertia::render('Infoseccions/Show', ['infoseccion' => $infoseccion, 'dias' => $dias,
        'aulas' => $aulas, 'horas' => $horas ]);
    }

    public function edit(Infoseccion $infoseccion)
    {
        $plans = Plan::select('id', 'codigo', 'nombre')->orderBy('codigo', 'ASC')->get();
        $periodos = Periodo::select('id', 'nombre')->where('activo', '=', 1)->get();
        $docentes = Docente::select('id', 'nombre')->get();
        
        return Inertia::render('Infoseccions/Edit', [ 'infoseccion' => $infoseccion,
            'plans' => $plans, 'periodos' => $periodos, 'docentes' => $docentes
        ]);
    }

    public function update(Request $request, Infoseccion $infoseccion)
    {
        $request->validate([
            'plan_id' => 'required',
            'docente_id' => 'required',
            'modalidad' => 'required',
            'cupo' => 'required', 
            'activo' => 'required',  
        ]);

        $infoseccion->update([
              'plan_id' => $request->plan_id,
              'periodo_id' => $periodo->id,
              'docente_id' => $request->docente_id,
              'modalidad' => $request->modalidad,
              'cupo' => $request->cupo,            
              'activo' => $request->activo,
              'updated_by' => auth()->user()->id,

        ]);

        $infoseccion->save();
        return redirect('infoseccions')->with('message', 'La sección se ha editado satisfactoriamente'); 
    }

    public function destroy(Infoseccion $infoseccion)
    {
       $id = $infoseccion->id;
       $dia = Dia::where('infoseccion_id', '=', $id)->first();
       $inscripcion = Inscripcion::where('infoseccion_id', '=', $id)->first();
       if($dia || $inscripcion) {
        return redirect('infoseccions')->with('message', 'La sección no puede ser eliminada ya que tiene horario asociado o alumnos inscritos');
       } else { 
        $infoseccion->delete();
          return redirect('infoseccions')->with('message', 'La sección se ha eliminado');
         }
    }

    public function carga() 
    {
        $periodo = Periodo::select('id', 'nombre')->where('activo', '=', 1)->orderBy('id', 'DESC')->first();
        $tip = auth()->user()->tipo;
        if($tip == 1) {
            $ced = auth()->user()->cedula;
            $docente = Docente::select('id', 'cedula', 'nombre')
             ->where('cedula', $ced)
             ->first();

            $infoseccions = Infoseccion::select('infoseccions.id', 'infoseccions.nombre', 'infoseccions.modalidad', 
            'plans.nombre as pnombre', 'dias.ndia', 'dias.hora_ent', 'dias.hora_sal', 'aulas.codigo')
                ->leftjoin('dias', 'dias.infoseccion_id', '=', 'infoseccions.id')
                ->leftjoin('aulas', 'aulas.id', '=', 'dias.aula_id')
                ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
                ->where('infoseccions.activo', '=', 1)
                ->where('infoseccions.periodo_id', '=', $periodo->id)
                ->where('infoseccions.docente_id', $docente->id)
                ->get();

            $horas = Hora::all();

            return Inertia::render('Carga-Acad/Show', ['periodo' => $periodo, 'docente' => $docente, 
            'infoseccions' => $infoseccions, 'horas' => $horas ]);

        } elseif($tip == 2) {  
            // Voy a buscar a los docentes que tengan carga academica en este periodo 
            $docentes = Docente::select('docentes.id', 'docentes.nombre', 'docentes.cedula')
                ->join('infoseccions', 'infoseccions.docente_id', '=', 'docentes.id')
                ->where('infoseccions.activo', '=', 1)
                ->where('infoseccions.periodo_id', '=', $periodo->id)
                ->groupBy('docentes.id', 'docentes.nombre', 'docentes.cedula')
                ->paginate(15);

            return Inertia::render('Carga-Acad/Index', ['docentes' => $docentes]);
        } else {
            return redirect('dashboard')->with('message', 'No tiene acceso a este modulo');
        }

    }

    public function cargadoc($cedula) 
    {
        $periodo = Periodo::select('id', 'nombre')->where('activo', '=', 1)->orderBy('id', 'DESC')->first();

            $docente = Docente::select('id', 'cedula', 'nombre')
             ->where('cedula', $cedula)
             ->first();

            $infoseccions = Infoseccion::select('infoseccions.id', 'infoseccions.nombre', 'infoseccions.modalidad', 
            'plans.nombre as pnombre', 'dias.ndia', 'dias.hora_ent', 'dias.hora_sal', 'aulas.codigo')
                ->leftjoin('dias', 'dias.infoseccion_id', '=', 'infoseccions.id')
                ->leftjoin('aulas', 'aulas.id', '=', 'dias.aula_id')
                ->join('plans', 'plans.id', '=', 'infoseccions.plan_id')
                ->where('infoseccions.activo', '=', 1)
                ->where('infoseccions.periodo_id', '=', $periodo->id)
                ->where('infoseccions.docente_id', $docente->id)
                ->get();

            $horas = Hora::all();

            return Inertia::render('Carga-Acad/Show', ['periodo' => $periodo, 'docente' => $docente, 
            'infoseccions' => $infoseccions, 'horas' => $horas ]);

    }
}
