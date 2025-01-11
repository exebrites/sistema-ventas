<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProductoRequest;
use App\Models\Material;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\DetalleProducto;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use SebastianBergmann\Environment\Runtime;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
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
    public function store(StoreUpdateProductoRequest $request) //Feature test
    {

        $producto = new Producto(); //porque no, crear un constructor y usar save()
        $producto->nombre = $request->validated(['name']);
        $producto->precio = $request->validated(['price']);
        $producto->descripcion = $request->validated(['description']);
        $producto->category_id = $request->validated(['categoria_id']);
        $producto->alias = $request->validated(['alias']);
        $producto->visitas = 0;
        $producto->imagen = $request;
        $producto->save();
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //Feature test
    {
        $producto = Producto::find($id);
        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //Feature test
    {
        $producto = Producto::find($id);
        $categorias = Categoria::all();

        return view('producto.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductoRequest $request, $id) //Feature test
    {

        $producto = Producto::find($request->id);
        // sino $url toma el valor que tenia imagen_path cuando no se actualiza la foto
        // si actualiza debe actualizar con la imagen ingresada
        if ($request->file('file') != null) {
            $producto->imagen = $request;
        }
        $producto->nombre = $request->validated(['name']);
        $producto->update([
            'precio' => $request->validated(['price']),
            // 'slug' => $request->validated(['name']),
            'descripcion' => $request->validated(['description']),
            'category_id' => $request->validated(['categoria_id']),
            'alias' => $request->validated(['alias'])
        ]);

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
        return view('detalleProducto', compact('producto', 'url_imagen'));
    }

    public function buscarProducto() //Feature test
    {
        $buscar = request()->get('buscar', '');
        if (request()->has('buscar')) {
            $busqueda = Producto::buscar($buscar)->get();
        }
        return view('producto.busqueda', compact('busqueda'));
    }
}
