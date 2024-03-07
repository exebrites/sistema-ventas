<?php

namespace App\Http\Controllers;

use App\Models\DetalleProducto;
use App\Models\Material;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editar()
    {
        return "editar";
    }
    public function eliminar($producto_id, $material_id)
    {
        $detalle = DetalleProducto::where('producto_id', $producto_id)
            ->where('material_id', $material_id)
            ->first();

        if ($detalle !== null) {
            $detalle->delete();
        }
        // dd($detalle);
        // return redirect()->route('detalleproducto.index');
    }
    public function index()
    {
        // $producto = Producto::find(1);
        // $materiales = Material::all();
        // return view('detalleProducto.index', compact('producto', 'materiales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        return $request;

        // return view('detalleProducto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $materiales = $request->all();
        // dd($materiales);
        $producto_id = $materiales['producto_id'];
        // dd($materiales['cantidades']);
        $materiales = $materiales['cantidades'];
        $materiales = array_filter($materiales, function ($valor) {
            return $valor !== null;
        });
        // return $materiales;
        foreach ($materiales as $key => $value) {
            # code...

            DetalleProducto::create([
                'producto_id' =>  $producto_id,
                'material_id' => $key,
                'cantidad' =>  $value
            ]);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        $detalleProducto = $producto->detalleProducto;
        return $detalleProducto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "editar";
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
    public function destroy(Request $request, $producto_id)
    {
        // $detalle =  DetalleProducto::find(producto_id=>$id);
        return $request;
    }
}
