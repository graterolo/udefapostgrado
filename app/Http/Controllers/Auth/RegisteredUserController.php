<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\alumno_censo;
use App\Models\Alumno;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'cedula' => 'required|exists:alumno_censos,cedula|exists:censo_masters,cedula,validado,1',
            'tipo' => 'required',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], ['cedula.exists' => 'Ups Usted no se ha censado o no ha pagado la preinscripción, no puede registrarse',]);

        $user = User::create([
            'name' => $request->name,
            'cedula' => $request->cedula,
            'tipo' => $request->tipo,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        

        event(new Registered($user));

        if($request->tipo==0) {  
            $cedula = $request->cedula;
            $alumno_censos = alumno_censo::select('alumno_censos.nombre1', 'alumno_censos.nombre2', 'alumno_censos.apellido1', 'alumno_censos.apellido2',
            'fecha_nac', 'alumno_censos.sexo', 'alumno_censos.direc_hab', 'alumno_censos.edo_hab', 'alumno_censos.ciud_hab', 'alumno_censos.telefono', 
            'alumno_censos.celular', 'alumno_censos.titulo' )->where('alumno_censos.cedula', '=', $cedula)->first();
            
            $alumno = Alumno::create([
                'cedula' => $request->cedula,
                'nombre1' => $alumno_censos->nombre1,
                'nombre2' => $alumno_censos->nombre2,
                'apellido1' => $alumno_censos->apellido1,
                'apellido2' => $alumno_censos->apellido2,
                'fecha_nac' => $alumno_censos->fecha_nac,
                'sexo' => $alumno_censos->sexo,
                'direc_hab' => $alumno_censos->direc_hab,
                'edo_hab' => $alumno_censos->edo_hab,
                'ciud_hab' => $alumno_censos->ciud_hab,
                'telefono' => $alumno_censos->telefono,
                'celular' => $alumno_censos->celular,
                'titulo' => $alumno_censos->titulo,
                'user_id' => $user->id, 
            ]);
            $alumno->save();
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);

    }
}
