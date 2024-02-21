<?php

namespace App\Http\Controllers;

use App\Models\ConfInscripcion;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ConfInscripcionController extends Controller
{
   
    public function index()
    {
        $tip = auth()->user()->tipo;
        if($tip == 2) {  
           $conf_inscripcions = ConfInscripcion::select('conf_inscripcions.id', 'conf_inscripcions.fecha_ini', 'conf_inscripcions.fecha_fin', 
           'periodos.nombre as pnombre')
             ->join('periodos', 'periodos.id', '=', 'conf_inscripcions.periodo_id')
             ->orderBy('conf_inscripcions.id', 'DESC')
             ->paginate(15);

             return Inertia::render('Conf-inscripcions/Index', ['conf_inscripcions' => $conf_inscripcions]);

        } else {
            return redirect('dashboard')->with('message', 'No tiene acceso a este modulo');
        }
    }

    public function create()
    {
        $periodos = Periodo::select('id', 'nombre')->where('activo', '=', 1)->get();

        return Inertia::render('Conf-inscripcions/Create', [
            'periodos' => $periodos
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'periodo_id' => 'required',
            'fecha_ini' => 'required',
            'fecha_fin' => 'required',
        ]);
           
        $confinscripcion = ConfInscripcion::create([
            'periodo_id' => $request->periodo_id,
            'fecha_ini' => $request->fecha_ini,
            'fecha_fin' => $request->fecha_fin,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,          
        ]);

        $confinscripcion->save();
        return redirect('conf-inscripcions')->with('message', 'Se ha creado la configuración de inscripción satisfactoriamente');
    }

    public function edit(ConfInscripcion $confInscripcion)
    {
        $periodos = Periodo::select('id', 'nombre')->where('activo', '=', 1)->get();
                
        return Inertia::render('Conf-inscripcions/Edit', [ 'confinscripcion' => $confInscripcion,
            'periodos' => $periodos
        ]);
    }

    public function update(Request $request, ConfInscripcion $confInscripcion)
    {
        $request->validate([
            'periodo_id' => 'required',
            'fecha_ini' => 'required',
            'fecha_fin' => 'required',
        ]);
        $confInscripcion->update([
            'periodo_id' => $request->periodo_id,
            'fecha_ini' => $request->fecha_ini,
            'fecha_fin' => $request->fecha_fin,
            'updated_by' => auth()->user()->id,          
        ]);

        $confInscripcion->save();
        return redirect('conf-inscripcions')->with('message', 'Se ha editado la configuración de inscripción satisfactoriamente');

    }

    public function destroy(ConfInscripcion $confInscripcion)
    {
        $confInscripcion->delete();
        return redirect('conf-inscripcions')->with('message', 'Se ha eliminado la configuración de inscripción satisfactoriamente');
    }
}
