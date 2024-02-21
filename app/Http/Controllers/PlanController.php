<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use App\Models\Plan;
use App\Models\Master;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use DB;

class PlanController extends Controller
{

    public function index(Request $request)
    {
        $tip = auth()->user()->tipo;
        if($tip == 2) {  
           $query = Plan::select('plans.id', 'plans.codigo', 'plans.nombre', 'plans.semestre', 'plans.uc', 
           'plans.horast', 'masters.siglas as siglas')
             ->join('masters', 'masters.id', '=', 'plans.master_id')
             ->orderBy('plans.codigo', 'ASC');


             // Filtrar por término de búsqueda si se proporciona
            if ($request->has('search')) {
               $searchTerm = $request->input('search');
                  $query->where(function ($query) use ($searchTerm) {
                  $query->where('siglas', 'like', "%$searchTerm%")
                        ->orWhere('codigo', 'like', "%$searchTerm%")
                        ->orWhere('plans.nombre', 'like', "%$searchTerm%");
             });
            }
            $plans = $query->paginate(10);

             return Inertia::render('Plans/Index', ['plans' => $plans]);

        } else {
            return redirect('dashboard')->with('message', 'No tiene acceso a este modulo');
        }
    }


    public function create()
    {
       $masters = Master::select('id', 'nombre')->where('activo', '=', 1)->get();
            
        return Inertia::render('Plans/Create', [
            'masters' => $masters
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'master_id' => 'required',
            'codigo' => 'required|string|max:6|min:6|unique:'.Plan::class,
            'nombre' => 'required|string|max:100',
            'semestre' => 'required', 
            'uc' => 'required',  
        ], [
            'codigo.unique' => 'El código ya existe. Por favor, ingrese un código diferente.',
            'codigo.min' => 'El código debe ser de 6 caracteres',
            'codigo.max' => 'El código debe ser de 6 caracteres',
        ]);
           
        $plan = Plan::create([
            'master_id' => $request->master_id,
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'prelacion1' => $request->prelacion1,
            'prelacion2' => $request->prelacion2,
            'semestre' => $request->semestre,            
            'uc' => $request->uc,
            'horast' => $request->horast,
            'horasp' => $request->horasp, 
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,

        ]);

        $plan->save();
        return redirect('plans')->with('message', 'La materia se ha creado satisfactoriamente');
    }


    public function show(Plan $plan)
    {          
        $id = $plan->id;
        $plan = Plan::select('plans.id', 'plans.codigo', 'plans.nombre', 'plans.prelacion1', 'plans.prelacion2',
        'plans.semestre', 'plans.uc', 'plans.horast', 'plans.horasp', 'plans.updated_at', 'plans.updated_by', 
        'masters.nombre as mnombre', 'users.name as name')
        ->join('masters', 'masters.id', '=', 'plans.master_id')
        ->join('users', 'users.id', '=', 'plans.updated_by')
        ->where('plans.id', '=', $id)
        ->first();
       
        return Inertia::render('Plans/Show', ['plan' => $plan ]);
    }


    public function edit(Plan $plan)
    {
        $masters = Master::select('id', 'nombre')->where('activo', '=', 1)->get();
        return Inertia::render('Plans/Edit', ['plan' => $plan, 'masters' => $masters
        ]);
    }


    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'master_id' => 'required',
            'codigo' => [
                'required', 'max:6', 'min:6',
                Rule::unique('plans')->ignore($plan->id),
            ],
            'nombre' => 'required|string|max:100',
            'semestre' => 'required',
            'uc' => 'required',   
        ], ['codigo.unique' => 'El código ya se encuentra registrado',
           'codigo.min' => 'El código debe ser de 6 caracteres',
           'codigo.max' => 'El código debe ser de 6 caracteres',]);

        $plan->update([
            'master_id' => $request->master_id,
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'prelacion1' => $request->prelacion1,
            'prelacion2' => $request->prelacion2,
            'semestre' => $request->semestre,            
            'uc' => $request->uc,
            'horast' => $request->horast,
            'horasp' => $request->horasp,
            'updated_by' => auth()->user()->id,

        ]);

        $plan->save();
        return redirect('plans')->with('message', 'La materia se ha editado satisfactoriamente'); 
    }


    public function destroy(Plan $plan)
    {
       $id = $plan->id;
       $infoseccion = Infoseccion::where('plan_id', '=', $id)->first();
       if($infoseccion) {
        return redirect('plans')->with('message', 'La materia no puede ser eliminado ya que tiene secciones asociadas');
       } else { 
        $plan->delete();
         return redirect('plans')->with('message', 'La materia se ha eliminado');
        }
    }
}
