<?php

namespace App\Http\Controllers;

use App\Models\PagoUc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;

class PagoUcController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index(Request $request)
    {
        // 1. Verificación de seguridad nativa de tu sistema
        if (auth()->user()->tipo !== 2) {
            return redirect('dashboard')->with('message', 'No tiene acceso a este modulo administrativo');
        }

        $search = $request->input('search');

        // 2. Subconsulta para aislar únicamente el ID del ÚLTIMO pago por cédula
        // Esto evita duplicar alumnos si han pagado múltiples veces en el tiempo
        $ultimoPagoSub = DB::table('pago_ucs')
            ->select('cedula', DB::raw('MAX(id) as max_id'))
            ->groupBy('cedula');

        // 3. Consulta principal unificando Preinscritos, Alumnos, Masters y el Último Pago
        $query = DB::table('preinscritos')
            ->join('alumnos', 'alumnos.cedula', '=', 'preinscritos.cedula')
            ->join('masters', 'masters.id', '=', 'preinscritos.master_id')
            // Acoplamos la subconsulta con un leftJoin para capturar los nulos como 0
            ->leftJoinSub($ultimoPagoSub, 'ultimos_pagos', function ($join) {
                $join->on('preinscritos.cedula', '=', 'ultimos_pagos.cedula');
            })
            ->leftJoin('pago_ucs', 'pago_ucs.id', '=', 'ultimos_pagos.max_id')
            ->select(
                'alumnos.id as alumno_id',
                'alumnos.nombre1',
                'alumnos.apellido1',
                'preinscritos.cedula',
                'masters.nombre as nombre_maestria',
                // Si es null (nunca ha pagado), SQL retorna 0 gracias a IFNULL o COALESCE
                DB::raw('COALESCE(pago_ucs.uc_pagadas, 0) as uc_pagadas'),
                DB::raw('COALESCE(pago_ucs.uc_disponibles, 0) as uc_disponibles')
            )
            ->orderBy('masters.nombre', 'ASC')
            ->orderBy('alumnos.apellido1', 'ASC');

        // 4. Buscador por cédula o nombre
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('preinscritos.cedula', 'like', "%{$search}%")
                  ->orWhere('alumnos.nombre1', 'like', "%{$search}%")
                  ->orWhere('alumnos.apellido1', 'like', "%{$search}%");
            });
        }

        // 5. Paginación estándar de 15 registros preservando la URL limpia
        $alumnosUcs = $query->paginate(15)->withQueryString();

        return Inertia::render('PagoUcs/Index', [
            'alumnosUcs' => $alumnosUcs,
            'filters' => $request->only(['search'])
        ]);
    }

    /**
     * Registra o acumula las nuevas unidades de crédito compradas en caja
     */
    public function cargarUc(Request $request): RedirectResponse
    {
        if (auth()->user()->tipo !== 2) {
            return redirect('dashboard')->with('message', 'Acción no autorizada');
        }

        $request->validate([
            'cedula' => 'required|string|max:15',
            'uc_a_cargar' => 'required|integer|min:1'
        ]);

        // Buscamos si el alumno posee un récord previo de saldo para acumular
        $ultimoPago = PagoUc::where('cedula', $request->cedula)
            ->orderByDesc('id')
            ->first();

        $ucDisponiblesActuales = $ultimoPago ? $ultimoPago->uc_disponibles : 0;

        // Creamos un nuevo registro histórico en la tabla de pagos (Auditoría limpia)
        PagoUc::create([
            'cedula'          => $request->cedula,
            'uc_pagadas'      => $request->uc_a_cargar,
            // Sumamos las nuevas UC compradas a las que ya tenía disponibles libres
            'uc_disponibles'  => $ucDisponiblesActuales + $request->uc_a_cargar,
            'fecha'           => now()->format('Y-m-d')
        ]);

        return redirect()->route('pagoucs.index')->with('message', 'Unidades de crédito cargadas y acumuladas con éxito');
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
    public function show(PagoUc $pagoUc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PagoUc $pagoUc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PagoUc $pagoUc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PagoUc $pagoUc)
    {
        //
    }
}
