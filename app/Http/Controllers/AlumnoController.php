<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Alumnos/Index', [
            'alumnos' => Alumno::paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        return Inertia::render('Alumnos/Show', ['alumno' => $alumno ]);
    }

    public function me(Request $request): Response
    {
        $id = $request->user()->id;
   
        $alumno = Alumno::where('user_id', '=', $id)->first();
       
        return Inertia::render('Alumnos/Show', [
            'alumno' => $alumno ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumno $alumno)
    {
        return Inertia::render('Alumnos/Edit', [ 'alumno' => $alumno]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumno $alumno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumno $alumno)
    {
        //
    }
}
