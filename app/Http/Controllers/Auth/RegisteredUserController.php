<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $dni = $request->dni;
        $apellido = $request->apellido;
        $telefono = $request->telefono;
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'dni' => ['required', Rule::unique('clientes', 'dni')]
            ]);
        } catch (ValidationException $e) {
            // Manejar los errores de validación aquí
            return redirect()->back()->withErrors($e->errors())->withInput();
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo_usuario' => 'cliente',
        ])->assignRole('cliente');

        // creacion de clientes y asignacion de rol


        Cliente::create([
            'dni' =>  $dni,
            'nombre' => $request->name,
            'apellido' => $apellido,
            'correo' => $request->email,
            'telefono' => $telefono
        ]);



        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
