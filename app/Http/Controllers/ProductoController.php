<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProductoRequest;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\DetallePedido;
use App\Models\Estado;
use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Services\ProductoService;

class ProductoController extends Controller
{


    protected const ESTADO_CANCELADO = 3;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index() //Feature test
    {
        $productos = Producto::orderBy('id', 'desc')->get(); //productos deforma descendente
        return view('producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //Feature test
    {
        $categorias = Categoria::all();
        return view('producto.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(StoreUpdateProductoRequest $request, ProductoService $productoService) //Feature test
    {
        // return $request;
        $productoService->crearProducto($request);
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto) //Feature test
    {

        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto) //Feature test
    {
        $categorias = Categoria::all();

        return view('producto.edit', [
            'producto' => $producto,
            'categorias' => $categorias
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductoRequest $request, $id, ProductoService $productoService) //Feature test
    {

        $producto = Producto::find($request->id);
        // sino $url toma el valor que tenia imagen_path cuando no se actualiza la foto
        // si actualiza debe actualizar con la imagen ingresada
        if ($request->file('file') != null) {
            $producto->imagen = $request;
        }
        $productoService->actualizarProducto($producto, $request);

        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //Feature test
    {

        // return $id;
        try {
            $producto = Producto::find($id);
            $detalles  = $producto->detalleProducto;
            // dd($detalles);
            foreach ($detalles as $key => $detalle) {
                # code...

                $detalle->delete();
            }
            $producto->delete();
            return redirect()->back()->with('success', 'Producto eliminado con éxito!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Manejar la excepción y proporcionar un mensaje descriptivo
            return redirect()->back()->with('error', 'El producto ' . $id . ' está relacionado a uno o varios pedidos.');
        }
    }

    //idea manejar con otra funcion la parte del detalle de productos
    public function detalle($id) //Feature test
    {

        $producto = Producto::find($id);
        // Incrementa el valor del campo 'cantidad' en 1
        $producto->increment('visitas');

        // Guarda los cambios en la base de datos
        $producto->save();

        $url_imagen = '';
        return view('detalleProducto', [
            'producto' => $producto,
            'url_imagen' => $url_imagen
        ]);
    }

    public function buscarProducto() //Feature test
    {
        $buscar = request()->get('buscar', '');
        if (request()->has('buscar')) {
            $busqueda = Producto::buscar($buscar)->get();
        }
        return view('producto.busqueda', compact('busqueda'));
    }
    public function actualizarStock(Producto $producto, Request $request)
    {
        try {
            //code...
            $request->validate([
                'cantidad' => 'required|numeric'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Ingrese una cantidad');
        }


        $producto = Producto::find($request->id);
        $cantidad = $request->cantidad;
        // dd($cantidad);
        //verificar que exita
        if (!$producto) {
            return redirect()->back()->with('error', 'El producto no existe');
        }
        // if (($producto->stock - $cantidad) <= 0) {
        //     return redirect()->back()->with('error', 'No hay suficiente stock, no se puede decrementar');
        // }
        //actualizar
        $producto->stock = $producto->stock + $cantidad;
        $producto->save();
        return redirect()->route('productos.index')->with('success', 'Stock actualizado');
    }

    public function cambiarEstado($id)
    {
        $producto   =  Producto::find($id);
        $producto->activo = !$producto->activo;
        $producto->save();

        $detalles = DetallePedido::where('producto_id', $id)->get();
        foreach ($detalles as  $detalle) {
            $detalle->pedidos()->update(['estado_id' => self::ESTADO_CANCELADO]);
        }

        return redirect()->route('productos.index')->with('success', 'Estado actualizado');
    }
}
