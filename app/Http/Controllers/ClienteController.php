<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('cliente.index', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'dni' => [
                    'required',
                    'string',
                    'min:8',
                    'max:8',
                    Rule::unique('clientes', 'dni'), // Ajusta 'tu_tabla' al nombre real de tu tabla de base de datos
                    'regex:/^\d{8}$/',
                ],
                'nombre' => ['required', 'string', 'max:100'],
                'apellido' => ['required', 'string', 'max:100'],
                'telefono' => ['required', 'regex:/^[0-9]{4}-[0-9]{6}$/'],
                'correo' => ['required', 'email', Rule::unique('clientes', 'correo'),],
            ]);
        } catch (ValidationException $e) {
            // Manejar los errores de validación aquí
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // Lógica adicional si la validación es exitosa
        // ...
        Cliente::create(
            [
                'dni' => $request->dni,
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'telefono' => $request->telefono,
                'correo' => $request->correo


            ]
        );
        return redirect()->route('clientes.index');
        // return redirect()->route('tu_ruta'); // Reemplaza 'tu_ruta' con la ruta a la que deseas redirigir
    }



    // Resto del código para almacenar el cliente en la base de datos




    // return $request;


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $cliente = User::find($id);
        $cliente =  Cliente::find($id);
        return view('cliente.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return $id;
        $cliente = Cliente::find($id);
        //  return $cliente;
        return view('cliente.edit', ['cliente' => $cliente]);
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
                'dni' => [
                    'required',
                    'string',
                    'min:8',
                    'max:8',
                    Rule::unique('clientes', 'dni'), // Ajusta 'tu_tabla' al nombre real de tu tabla de base de datos
                    'regex:/^\d{8}$/',
                ],
                'nombre' => ['required', 'string', 'max:100'],
                'apellido' => ['required', 'string', 'max:100'],
                'telefono' => ['required', 'regex:/^[0-9]{2,4}-[0-9]{6,8}$/'],
                'correo' => ['required', 'email', Rule::unique('clientes', 'correo')->ignore($request->id),],
            ]);
        } catch (ValidationException $e) {
            // Manejar los errores de validación aquí
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // Lógica adicional si la validación es exitosa
        // ...
        Cliente::find($request->id)->update([
            'dni' => $request->dni,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'correo' => $request->correo
        ]);
        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect()->route('clientes.index');
    }
}
