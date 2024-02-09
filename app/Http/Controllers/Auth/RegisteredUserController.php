<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AlumnoCenso;
use App\Models\Alumno;
use App\Models\CensoMaster;
use App\Models\Preinscrito;
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
        if($request->tipo==1) {
            $request->validate([
                'name' => 'required|string|max:100',
                'cedula' => 'required|exists:docentes,cedula|unique:'.User::class,
                'tipo' => 'required',
                'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ], ['cedula.exists' => 'Usted no ha sido registrado como docente, notifiquelo ha su contacto, no puede registrarse']);
    
            $user = User::create([
                'name' => $request->name,
                'cedula' => $request->cedula,
                'tipo' => $request->tipo,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            event(new Registered($user));

        } elseif($request->tipo==0) {  
            $request->validate([
                'name' => 'required|string|max:100',
                'cedula' => 'required|exists:alumno_censos,cedula|exists:censo_masters,cedula,validado,1',
                'tipo' => 'required',
                'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ], [
                'cedula.unique' => 'Esta cédula ya se encuentra registrada.',
                'cedula.exists' => 'Ups Usted no se ha censado o no ha pagado la preinscripción, no puede registrarse',
            ]);

            $user = User::create([
                'name' => $request->name,
                'cedula' => $request->cedula,
                'tipo' => $request->tipo,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);       

            event(new Registered($user));
       
            $cedula = $request->cedula;
            $alumno_censos = AlumnoCenso::select('alumno_censos.nombre1', 'alumno_censos.nombre2', 'alumno_censos.apellido1', 'alumno_censos.apellido2',
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

            $censo_masters = CensoMaster::select('censo_masters.cedula', 'censo_masters.master_id', 'censo_masters.validado' )
                ->where('censo_masters.cedula', '=', $cedula)
                ->where('censo_masters.validado', '=', 1)
                ->orderBy('censo_masters.id','DESC')
                ->first();

            $preinscrito = Preinscrito::create([
                'cedula' => $request->cedula,
                'master_id' => $censo_masters->master_id,
                'user_id' => $user->id,
            ]);
            $preinscrito->save();
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);

    }
}
