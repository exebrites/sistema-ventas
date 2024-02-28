<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedor.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        try {
            $request->validate([
                'empresa' => ['required', 'string', 'max:255'],
                'nombre_contacto' => ['required', 'string', 'max:255'],
                'cuit' => ['required', 'string', 'max:13', Rule::unique('proveedores', 'cuit')],
                'telefono' => ['required',],
                'correo' => ['required', 'email', 'max:255', Rule::unique('proveedores', 'correo')],
            ]);
        } catch (ValidationException $e) {
            // Manejar los errores de validación aquí
            dd($e);
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        Proveedor::create([

            'nombre_empresa' => $request->empresa,
            'nombre_contacto' => $request->nombre_contacto,
            'cuit' => $request->cuit,
            'telefono' => $request->telefono,
            'correo' => $request->correo
        ]);

        return redirect()->route('proveedores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedor = Proveedor::find($id);
        return view('proveedor.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $proveedor = Proveedor::find($id);
        return view('proveedor.edit', compact('proveedor'));
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
                'empresa' => ['required', 'string', 'max:255'],
                'nombre_contacto' => ['required', 'string', 'max:255'],
                'cuit' => ['required', 'string', 'max:13', Rule::unique('proveedores', 'cuit')->ignore($request->id)],
                'telefono' => ['required',],
                'correo' => ['required', 'email', 'max:255', Rule::unique('proveedores', 'correo')->ignore($request->id)],
            ]);
        } catch (ValidationException $e) {
            // Manejar los errores de validación aquí
            // dd($e);
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        Proveedor::find($request->id)->update([

            'nombre_empresa' => $request->empresa,
            'nombre_contacto' => $request->nombre_contacto,
            'cuit' => $request->cuit,
            'telefono' => $request->telefono,
            'correo' => $request->correo
        ]);
        return redirect()->route('proveedores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->delete();

        return redirect()->route('proveedores.index');
    }
}
