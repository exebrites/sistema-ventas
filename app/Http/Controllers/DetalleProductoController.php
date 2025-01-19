<?php

namespace App\Http\Controllers;

use App\Models\DetalleProducto;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Proveedor;

class DetalleProductoController extends Controller
{
    public function index()
    {
        $detalleProductos = DetalleProducto::all();
        return view('detalleProducto.index', compact('detalleProductos'));
    }
    public function show($id)
    {

        $producto  = Producto::find($id);
        return view('detalleProducto.show', compact('producto'));
    }
    public function create()
    {
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        return view('detalleProducto.create', [
            'productos' => $productos,
            'proveedores' => $proveedores
        ]);
    }
    public function store(Request $request)
    {

        $proveedores  =  $request->proveedores;
        foreach ($proveedores as  $proveedor) {

            DetalleProducto::create([
                'producto_id' => $request->producto_id,
                'proveedor_id' => $proveedor
            ]);
        }
        return redirect()->route('productos.index')->with('success', 'Productos asociados con exito');
    }
}
