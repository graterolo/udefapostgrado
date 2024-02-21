<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index()
    {   
        return Inertia::render('Users/Index', [
            'users' => User::where('tipo', '=', 2)
            ->orwhere('tipo', '=', 1)
            ->paginate(5)
        ]);
    }

    public function create(): Response
    {   
        return Inertia::render('Users/Create');
    }
    public function store(Request $request)
    {   

        if($request->tipo==1) {
            $request->validate([
                'name' => 'required|string|max:255',
                'cedula' => 'required|exists:docentes,cedula|unique:'.User::class,
                'tipo' => 'required',
                'email' => 'required|string|email|max:255|unique:'.User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],            
            ], ['cedula.unique' => 'La cédula ya se encuentra registrada',
                'cedula.exists' => 'Debe registrar al docente',
                'email.unique' => 'El correo electrónico ya está en uso. Por favor, ingrese un correo electrónico diferente.',
            ]);
        } elseif($request->tipo==2) {
            $request->validate([
                'name' => 'required|string|max:255',
                'cedula' => 'required|unique:'.User::class,
                'tipo' => 'required',
                'email' => 'required|string|email|max:255|unique:'.User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],            
            ], ['cedula.unique' => 'La cédula ya se encuentra registrada',
                'email.unique' => 'El correo electrónico ya está en uso. Por favor, ingrese un correo electrónico diferente.',
            ]);
        }           
        $user = User::create([
            'name' => $request->name,
            'cedula' => $request->cedula,
            'tipo' => $request->tipo,
            'email' => $request->email,
            'password' => Hash::make($request->password),          
        ]);

        $user->save();
        return redirect('users')->with('message', 'El usuario se ha creado satisfactoriamente');
    }

    public function edit(User $user){
        
        return Inertia::render('Users/Edit', [ 'user' => $user]);
    }

    public function update(Request $request, User $user){
        $request->validate([
            'name' => 'required|string|max:255',
            'cedula' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
            'tipo' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],], ['cedula.unique' => 'La cédula ya se encuentra registrada',
                'email.unique' => 'El correo electrónico ya está en uso. Por favor, ingrese un correo electrónico diferente.',
        ]);
        //$user->update($request->all());
        $user->update([
            'name'   => $request->name,
            'cedula' => $request->cedula,
            'tipo' => $request->tipo,
            'email' => $request->email,
        ]);
        $user->save();
        return redirect('users')->with('message', 'El usuario se ha editado satisfactoriamente');
    }
    public function show(User $user)
    {      
        return Inertia::render('Users/Show', ['user' => $user ]);
        
    }


}
