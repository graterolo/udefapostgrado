<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Docentes/Index', [
            'docentes' => Docente::paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Docentes/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'cedula' => 'required|string|max:15',
            'nombre' => 'required|string|max:50',
            'sexo' => 'required',
            'direc_hab' => 'required|string|max:255',
            'edo_hab' => 'required|string|max:30',  
            'ciud_hab' => 'required|string|max:30',
            'telefono' => 'required|string|max:25',
            'celular' => 'required|string|max:25',         
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

    /**
     * Display the specified resource.
     */
    public function show(Docente $docente)
    {
        return Inertia::render('Docentes/Show', ['docente' => $docente ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Docente $docente)
    {
        return Inertia::render('Docentes/Edit', [ 'docente' => $docente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Docente $docente)
    {
        $request->validate([
            'cedula' => 'required|string|max:15',
            'nombre' => 'required|string|max:50',
            'sexo' => 'required',
            // 'direc_hab' => 'required|string|max:255',
            // 'edo_hab' => 'required|string|max:30',  
            // 'ciud_hab' => 'required|string|max:30',
            // 'telefono' => 'required|string|max:25',
            // 'celular' => 'required|string|max:25',         
        ]);
        $docente->update($request->all());
        // $docente->update([
        //     'cedula' => $request->cedula,
        //     'nombre' => $request->nombre,
        //     'sexo' => $request->sexo,
        //     'direc_hab' => $request->direc_hab,
        //     'edo_hab' => $request->edo_hab,
        //     'ciud_hab' => $request->ciud_hab,
        //     'telefono' => $request->telefono,
        //     'celular' => $request->celular,
        // ]);
        $docente->save();
        return redirect('docentes')->with('message', 'El docente se ha editado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Docente $docente)
    {
        //
    }
}
