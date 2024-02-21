<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AlumnoController extends Controller
{

    public function index()
    {
        $tip = auth()->user()->tipo;
        if($tip == 0) {
            $ced = auth()->user()->cedula;
            $alumno = Alumno::where('cedula', '=', $ced)->first();
            return Inertia::render('Alumnos/Show', ['alumno' => $alumno ]);

        } elseif($tip == 2) {  
            $alumnos = Alumno::select('alumnos.id', 'alumnos.nombre1', 'alumnos.apellido1', 'alumnos.cedula', 
            'alumnos.telefono', 'alumnos.titulo', 'users.email as email')
            ->join('users', 'users.id', '=', 'alumnos.user_id')
            ->orderBy('alumnos.apellido1','ASC')
            ->paginate(15);

            return Inertia::render('Alumnos/Index', [
               'alumnos' => $alumnos
            ]);
        }
    }

    public function show(Alumno $alumno)
    {
        return Inertia::render('Alumnos/Show', ['alumno' => $alumno ]);
         
    }

    public function edit(Alumno $alumno)
    {
        return Inertia::render('Alumnos/Edit', [ 'alumno' => $alumno]);
    }

    public function update(Request $request, Alumno $alumno)
    {
        $request->validate([
            'cedula' => 'required|string|max:15',
            'nombre1' => 'required|string|max:20',
            'nombre2' => 'string|max:20',
            'apellido1' => 'required|string|max:20',
            'apellido2' => 'string|max:20',
            'fecha_nac' => 'required',
            'sexo' => 'required',
            'direc_hab' => 'required|string|max:255',
            'edo_hab' => 'required|string|max:30',  
            'ciud_hab' => 'required|string|max:30',
            'telefono' => 'required|string|max:30',
            'celular' => 'string|max:25',
            'titulo' => 'required|string|max:50',         
        ]);
        $alumno->update($request->all());
        return redirect('alumnos')->with('message', 'Datos modificados satisfactoriamente');
    }

    public function destroy(Alumno $alumno)
    {
        //
    }
}
