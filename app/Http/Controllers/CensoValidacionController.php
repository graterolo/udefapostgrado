<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CensoMaster;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;

class CensoValidacionController extends Controller
{
    public function index(Request $request)
    {
        // 1. Seguridad nativa basada en tu estilo de roles
        $tip = auth()->user()->tipo;
        if ($tip !== 2) {
            return redirect('dashboard')->with('message', 'No tiene acceso a este modulo administrativo');
        }

        // 2. Captura el término de búsqueda enviado desde la URL
        $search = $request->input('search');

        // 3. Query base con Joins explícitos (Tal cual como lo haces en Preinscritos)
        $query = DB::table('censo_masters')
            ->join('alumno_censos', 'alumno_censos.cedula', '=', 'censo_masters.cedula')
            ->join('masters', 'masters.id', '=', 'censo_masters.master_id')
            ->select(
                'censo_masters.id',
                'censo_masters.cedula',
                'censo_masters.fecha',
                'censo_masters.validado',
                'alumno_censos.nombre1',
                'alumno_censos.apellido1',
                'masters.nombre as nombre_maestria'
            );

        // 4. Si el usuario escribió en el buscador, filtramos en toda la BD
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('censo_masters.cedula', 'like', "%{$search}%")
                  ->orWhere('alumno_censos.nombre1', 'like', "%{$search}%")
                  ->orWhere('alumno_censos.apellido1', 'like', "%{$search}%");
            });
        }

        // 5. Paginamos (15 registros) y preservamos la URL limpia con withQueryString()
        $censos = $query->orderBy('censo_masters.id', 'DESC')->paginate(15)->withQueryString();

        return Inertia::render('Censos/Index', [
            'censos' => $censos,
            'filters' => $request->only(['search']) // Devolvemos el filtro para mantener el input lleno
        ]);
    }

    public function validar($id): RedirectResponse
    {
        if (auth()->user()->tipo !== 2) {
            return redirect('dashboard')->with('message', 'No tiene acceso a este modulo');
        }

        // Actualizamos el flag del censo a 1
        $censo = CensoMaster::findOrFail($id);
        $censo->validado = 1;
        $censo->save();

        return redirect('censos')->with('message', 'Preinscripción del censo validada satisfactoriamente');
    }
}
