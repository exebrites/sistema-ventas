<?php

namespace App\Http\Controllers;

use Rules\Password;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UsuarioProveedorMailable;
use Illuminate\Validation\ValidationException;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios =  User::all();

        // return  $usuarios;
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required'], 'tipo_usuario' => ['required']


            ]);
        } catch (ValidationException $e) {
            // Manejar los errores de validación aquí
            return redirect()->back()->withErrors($e->errors())->withInput();
        }



        $password = $request->password;
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo_usuario' => $request->tipo_usuario
        ]);

        //enviar correo al proveedor con su usuario y contraseña
        // $user->email
        // Mail::to('exe@gmail.com')->send(new UsuarioProveedorMailable($user, $password));
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($request->usuario_id),
                ],
                'tipo_usuario' => ['required']


            ]);
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->errors())->withInput();
        }


        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo_usuario' => $request->tipo_usuario
        ]);

        //enviar correo al proveedor con su usuario y contraseña
        // $user->email
        // Mail::to('exe@gmail.com')->send(new UsuarioProveedorMailable($user, $password));
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado  con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado  con éxito');
    }

    public function showAssignMultipleRolesForm($userId)
    {
        $user = User::findOrFail($userId);
        $roles = Role::all();

        return view('usuarios.edit_rol', compact('user', 'roles'));
    }
    public function assignMultipleRoles(Request $request, $userId)
    {

        $user = User::findOrFail($request->user_id);
        $roles = $request->input('roles');

        $user->syncRoles($roles);

        return redirect()->back()->with('message', 'Roles asignados correctamente');
    }
    public function removeMultipleRoles(Request $request, $userId)
    {
        $userId = $request->user_id;
        $user = User::findOrFail($userId);
        $rolesToRemove = $request->input('roles');
        foreach ($rolesToRemove as $role) {
            $user->removeRole($role);
        }

        return redirect()->back()->with('message', 'Roles removidos correctamente');
    }
}
