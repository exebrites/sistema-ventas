<?php

namespace App\Http\Controllers;

use App\Models\DetalleProducto;
use App\Models\Material;
use App\Models\Producto;
use Exception;
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
    public function crear_detalle_producto()
    {
        // return "fabricacion";

        return view('detalleProducto.create');
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
            //code...

            // return $request;
            $producto_id = $request->producto_id;
            // dd($producto_id);
            $materiales = $request->materiales;
            //materiales -> cantidad 
            // dd($materiales);


            foreach ($materiales as $material => $cantidad) {
                // dd($material);
                $existe = DetalleProducto::where('producto_id', $producto_id)
                    ->where('material_id', $material)->exists();
                if ($existe) {
                    continue;
                }

                DetalleProducto::create([
                    'producto_id' => $producto_id,
                    'material_id' => $material,
                    'cantidad' => $cantidad
                ]);
            }
        } catch (Exception $e) {
            //throw $th;

            return $e;
        }

        // $producto_id = $materiales['producto_id'];
        // // dd($materiales['cantidades']);
        // $materiales = $materiales['cantidades'];
        // $materiales = array_filter($materiales, function ($valor) {
        //     return $valor !== null;
        // });
        // // return $materiales;
        // foreach ($materiales as $key => $value) {
        //     # code...

        //     DetalleProducto::create([
        //         'producto_id' =>  $producto_id,
        //         'material_id' => $key,
        //         'cantidad' =>  $value
        //     ]);
        // }
        $producto = Producto::find($producto_id);
        return redirect()->route('detalleproducto.show', $producto->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Objetivo :  redireccionar a crear detalle en caso que no tenga el producto. Sino mostrar los detalles 
        $producto = Producto::find($id);
        if (DetalleProducto::where('producto_id', $id)->count() == 0) {
            $materiales = Material::all();
            return view('detalleProducto.create', compact('producto', 'materiales'));
        }
        $detalleProducto = DetalleProducto::select('*')->where('producto_id', $id)->get();
        return view('detalleProducto.show', compact('producto', 'detalleProducto'));
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
