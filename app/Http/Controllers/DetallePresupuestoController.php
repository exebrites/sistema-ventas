<?php

namespace App\Http\Controllers;

use App\Models\DetallePresupuesto;
use App\Models\Presupuesto;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetallePresupuestoController extends Controller
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
    public function create($id)
    {
        $presupuesto = Presupuesto::find($id);
        $productos = Producto::all();
        return view('detallePresupuesto.create', compact('presupuesto', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DetallePresupuesto::create([
            'producto_id' => $request->producto_id,
            'presupuesto_id' => $request->presupuesto_id,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio
        ]);

        $presupuesto =  Presupuesto::find($request->presupuesto_id);
        $detalles = DetallePresupuesto::all();
        $productos = Producto::all();
        return view('detallePresupuesto.index', compact('detalles', 'presupuesto'));
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
