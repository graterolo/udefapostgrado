<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;

use App\Models\Dia;
use App\Models\Infoseccion;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DiaController extends Controller
{
    public function store(Request $request)
    {  
       $request->validate([
        'infoseccion_id' => 'required',
        'ndia' => 'required',
        'hora_ent' => 'required',
        'hora_sal' => 'required',   
    ]);
    $dia = Dia::create([
        'infoseccion_id' => $request->infoseccion_id,
        'ndia' => $request->ndia,
        'hora_ent' => $request->hora_ent, 
        'hora_sal' => $request->hora_sal, 
        'created_by' => auth()->user()->id,
        'updated_by' => auth()->user()->id,         
    ]);
    $dia->save();
    return Redirect::back();
    }

    public function update(Request $request, Dia $dia)
     {   
        $request->validate([
            'infoseccion_id' => 'required',
            'ndia' => 'required',
            'hora_ent' => 'required',
            'hora_sal' => 'required',   
        ]);
        $dia->update([
            'infoseccion_id' => $request->infoseccion_id,
            'ndia' => $request->ndia,
            'hora_ent' => $request->hora_ent, 
            'hora_sal' => $request->hora_sal, 
            'updated_by' => auth()->user()->id,         
        ]);
        $dia->save();
        return Redirect::back();
    }


    public function destroy(Dia $dia)
    {
        $dia->delete();
        return Redirect::back();
    }
}
