<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use DB;

class DocenteController extends Controller
{

    public function index()
    {
        $tip = auth()->user()->tipo;
        if($tip == 1) {
            $ced = auth()->user()->cedula;
            $docente = Docente::where('cedula', '=', $ced)->first();
            return Inertia::render('Docentes/Show', ['docente' => $docente ]);

        } elseif($tip == 2) {  
        return Inertia::render('Docentes/Index', [
            'docentes' => Docente::paginate(10)
        ]);
        }
    }

    public function create()
    {
        return Inertia::render('Docentes/Create');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'cedula' => 'required|string|max:15',
            'nombre' => 'required|string|max:50',
            'sexo' => 'required',   
        ]);
           
        $docente = Docente::create([
            'cedula' => $request->cedula,
            'nombre' => $request->nombre,
            'sexo' => $request->sexo,
            'direc_hab' => $request->direc_hab,
            'edo_hab' => $request->edo_hab,
            'ciud_hab' => $request->ciud_hab,
            'telefono' => $request->telefono,
            'celular' => $request->celular,            
        ]);

        $docente->save();
        return redirect('docentes')->with('message', 'El docente se ha creado satisfactoriamente');
    }

    public function show(Docente $docente)
    {
        return Inertia::render('Docentes/Show', ['docente' => $docente ]);
       
    }

    public function edit(Docente $docente)
    {
        return Inertia::render('Docentes/Edit', [ 'docente' => $docente]);
    }

    public function update(Request $request, Docente $docente)
    {
        $request->validate([
            'cedula' => 'required|string|max:15',
            'nombre' => 'required|string|max:50',
            'sexo' => 'required',
         
        ]);
        $docente->update($request->all());

        $docente->save();
        return redirect('docentes')->with('message', 'El docente se ha editado satisfactoriamente');
    }


    public function destroy(Docente $docente)
    {
        //
    }
}
