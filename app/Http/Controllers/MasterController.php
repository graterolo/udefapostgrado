<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\Plan;
use App\Models\Master;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MasterController extends Controller
{

    public function index()
    {
        $tip = auth()->user()->tipo;
        if($tip == 2) {  
        return Inertia::render('Masters/Index', [
            'masters' => Master::paginate(5)
        ]);
        } else {
            return redirect('dashboard')->with('message', 'No tiene acceso a este modulo');
        }
    }

    public function create()
    {
        return Inertia::render('Masters/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'siglas' => 'required|string|max:4|unique:'.Master::class,
            'nombre' => 'required|string|max:100',
            'activo' => 'required',   
        ], ['siglas.unique' => 'La sigla se encuentra registrada.',
    ]);
           
        $master = Master::create([
            'siglas' => $request->siglas,
            'nombre' => $request->nombre,
            'activo' => $request->activo,           
        ]);

        $master->save();
        return redirect('masters')->with('message', 'La maestría o postgrado se ha creado satisfactoriamente');
    }


    public function show(master $master)
    {  
      $mid = $master->id;
      $plans = Plan::select('plans.id as pid', 'plans.codigo', 'plans.nombre', 'plans.prelacion1', 'plans.semestre', 
     'plans.uc', 'plans.horast', 'plans.horasp')
           ->where('plans.master_id', '=', $mid)->get();
       
           return Inertia::render('Masters/Show', ['master' => $master, 'plans' => $plans ]);
    }


    public function edit(master $master)
    {
        return Inertia::render('Masters/Edit', [ 'master' => $master]);
    }

    public function update(Request $request, master $master)
    {
        $request->validate([
            'siglas' => [
                'required', 'max:4',
                Rule::unique('masters')->ignore($master->id),
            ],
            'nombre' => 'required|string|max:100',
            'activo' => 'required',   
        ], ['siglas.unique' => 'La sigla ya se encuentra registrada']);
        $master->update($request->all());

        $master->save();
        return redirect('masters')->with('message', 'La maestría o postgrado se ha editado satisfactoriamente');
    }

    public function destroy(master $master)
    {
       $id = $master->id;
       $plan = Plan::where('master_id', '=', $id)->first();
       if($plan) {
        return redirect('masters')->with('message', 'La maestría o postgrado no puede ser eliminado ya que tiene materias asociadas');
       } else { 
        $master->delete();
        return redirect('masters')->with('message', 'La maestría o postgrado se ha eliminado');
       }
    }
}
