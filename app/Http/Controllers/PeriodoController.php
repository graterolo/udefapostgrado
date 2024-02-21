<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\Periodo;
use App\Models\Infoseccion;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PeriodoController extends Controller
{

    public function index()
    {
        $tip = auth()->user()->tipo;
        if($tip == 2) {  
            $periodos = Periodo::select('id', 'nombre', 'fecha_ini', 'fecha_fin', 'activo')
            ->orderByDesc('id')
            ->paginate(5);
            
        return Inertia::render('Periodos/Index', [
            'periodos' => $periodos
        ]);
        } else {
            return redirect('dashboard')->with('message', 'No tiene acceso a este modulo');
        }
    }


    public function create()
    {
        return Inertia::render('Periodos/Create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:6|unique:'.Periodo::class,
            'fecha_ini' => 'required',
            'fecha_fin' => 'required',
            'activo' => 'required',   
        ], ['nombre.unique' => 'El período se encuentra registrado.',
    ]);
           
        $periodo = Periodo::create([
            'nombre' => $request->nombre,
            'fecha_ini' => $request->fecha_ini,
            'fecha_fin' => $request->fecha_fin,
            'activo' => $request->activo, 
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,          
        ]);

        $periodo->save();
        return redirect('periodos')->with('message', 'El período se ha creado satisfactoriamente');
    }


    public function show(Periodo $periodo)
    {
        $pid = $periodo->id;
        $infoseccions = Infoseccion::select('infoseccions.id as iid', 'infoseccions.nombre', 'infoseccions.modalidad', 'infoseccions.cupo', 'infoseccions.activo', 
        'docentes.nombre as dnombre')
           ->join('docentes', 'docentes.id', '=', 'infoseccions.docente_id')
           ->where('infoseccions.periodo_id', '=', $pid)
           ->orderBy('infoseccions.nombre','ASC')
           ->get(); // la paginacion da error, se elimino
           
       
        return Inertia::render('Periodos/Show', ['periodo' => $periodo, 'infoseccions' => $infoseccions ]);
    }


    public function edit(Periodo $periodo)
    {
        return Inertia::render('Periodos/Edit', ['periodo' => $periodo ]);
    }


    public function update(Request $request, Periodo $periodo)
    {
        $request->validate([
            'nombre' => [
                'required', 'max:6',
                Rule::unique('periodos')->ignore($periodo->id),
            ],
            'fecha_ini' => 'required',
            'fecha_fin' => 'required',
            'activo' => 'required',   
        ], ['nombre.unique' => 'El período ya se encuentra registrado']);
        $periodo->update($request->all());

        $periodo->save();
        return redirect('periodos')->with('message', 'El período se ha editado satisfactoriamente');
    }


    public function destroy(Periodo $periodo)
    {
       $id = $periodo->id;
       $infoseccion = Infoseccion::where('periodo_id', '=', $id)->first();
       if($infoseccion) {
        return redirect('periodos')->with('message', 'El período no puede ser eliminado ya que tiene secciones asociadas');
       } else { 
        $periodo->delete();
        return redirect('periodos')->with('message', 'El período se ha eliminado');
        }
    }
}
