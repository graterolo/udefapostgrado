<?php

namespace App\Http\Controllers;

use App\Models\Preinscrito;
//use App\Models\master;
//use App\Models\Alumno;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
//use DB;

class PreinscritoController extends Controller
{

    public function index()
    {
        $tip = auth()->user()->tipo;
        if($tip == 0) {
            $ced = auth()->user()->cedula; 
           
          $preinscrito = Preinscrito::select('preinscritos.id', 'preinscritos.cedula', 'preinscritos.master_id', 'preinscritos.updated_at', 'alumnos.nombre1', 
          'alumnos.apellido1', 'masters.nombre')
          ->join('alumnos', 'alumnos.cedula', '=', 'preinscritos.cedula')
          ->join('masters', 'masters.id', '=', 'preinscritos.master_id')
          ->where('preinscritos.cedula', '=', $ced)
          ->first(); 
          return Inertia::render('Preinscritos/Show', ['preinscrito' => $preinscrito ]);
          

        } elseif($tip == 2) {  
            $preinscritos = Preinscrito::select('preinscritos.id', 'preinscritos.cedula', 'preinscritos.master_id', 'preinscritos.updated_at', 'alumnos.nombre1', 
        'alumnos.apellido1', 'masters.nombre')
        ->join('alumnos', 'alumnos.cedula', '=', 'preinscritos.cedula')
        ->join('masters', 'masters.id', '=', 'preinscritos.master_id')
        ->orderBy('masters.nombre', 'ASC')
        ->paginate(5);

        return Inertia::render('Preinscritos/Index', ['preinscritos' => $preinscritos]);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(Preinscrito $preinscrito)
    {

        $ced = $preinscrito->cedula;
        $preinscrito = Preinscrito::select('preinscritos.id', 'preinscritos.cedula', 'preinscritos.master_id', 'preinscritos.updated_at', 'alumnos.nombre1', 
            'alumnos.apellido1', 'masters.nombre')
            ->join('alumnos', 'alumnos.cedula', '=', 'preinscritos.cedula')
            ->join('masters', 'masters.id', '=', 'preinscritos.master_id')
            ->where('preinscritos.cedula', '=', $ced)
            ->first();
            return Inertia::render('Preinscritos/Show', ['preinscrito' => $preinscrito ]);

    }

    public function edit(Preinscrito $preinscrito)
    {
    //     $mid = $preinscrito->master_id;
    //     $master = Master::find($mid);
    //     $ced = $preinscrito->cedula;
    //     $alumno = Alumno::find('cedula', $ced);

    //    return Inertia::render('Preinscritos/Edit', [
    //        'preinscrito' => $preinscrito
           // 'master' => $master,
           // 'alumno' => $alumno,
    // ]);
        return Inertia::render('Preinscritos/Edit', ['preinscrito' => $preinscrito ]);
    }

    public function update(Request $request, Preinscrito $preinscrito)
    {
        $request->validate([
            'cedula' => 'required|string|max:15',
            'master_id' => 'required',      
        ]);
        $preinscrito->update($request->all());
        return redirect('preinscritos')->with('message', 'Preinscripción modificada satisfactoriamente');
    }

    public function destroy(Preinscrito $preinscrito)
    {
        //
    }
}
