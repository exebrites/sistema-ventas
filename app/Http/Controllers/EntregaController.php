<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Pedido;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $id = $request->id;
        Entrega::create([
            'pedido_id' => $id,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'recepcion' => $request->nombre,
            'nota' => $request->nota,
            'local' => true,
        ]);
        $estado = $request->estado;
        $p = Pedido::find($id);
        $p->update(['estado_id' => $estado + 1]);

        return redirect()->route('shop')->with('success_msg', 'Su pedido ha sido completado con exito! Puede ver el estado de avance en "Tus pedidos"');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
