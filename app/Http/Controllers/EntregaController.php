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

        // return $request;
        $id = $request->id;
        // dd($request->id);
        if ($request->local == null) {

            $direccion = ($request->direccion != null) ? $request->direccion : " ";
            $nombre = ($request->nombre != null) ? $request->nombre : " ";
            $nota = ($request->nota != null) ? $request->nota : " ";

            Entrega::create([
                'pedido_id' => $id,
                'direccion' => $direccion,
                'telefono' => " ",
                'recepcion' => $nombre,
                'nota' => $nota,
                'local' => false,
            ]);
        } else {
            Entrega::create([
                'pedido_id' => $id,
                'direccion' => " ",
                'telefono' => " ",
                'recepcion' => " ",
                'nota' => " ",
                'local' => true,
            ]);
        }


        $estado = $request->estado;
        $p = Pedido::find($id);
        $p->update(['estado_id' => $estado + 1]);

        return redirect()->route('shop')->with('success_msg', 'Su pedido ha sido completado con exito! Puede ver el estado de avance en "Tus pedidos"');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @returern \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entrega = Entrega::find($id);
        return view('entrega.show', compact('entrega'));
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
