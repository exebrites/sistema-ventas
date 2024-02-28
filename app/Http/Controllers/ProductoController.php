<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Runtime;
use Illuminate\Validation\ValidationException;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $pedidos = Pedido::paginate(10)
        // $productos = Producto::paginate();
        // $productos= Producto::all();
        $productos = Producto::orderBy('id', 'desc')->get();
        // dd($productos);
        return view('producto.index', ['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('producto.create');
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
                'name' => ['required', 'string', 'max:255'],
                'price' => 'required|numeric|min:0|max:100000',
                'alias' => ['required', 'string', 'max:255', Rule::unique('productos', 'alias')],
                // 'description' => ['required', 'string'],
                'description' => ['string', 'max:255'],
                'file' => ['required', 'file', 'mimes:jpeg,png', 'max:2048']

            ]);
        } catch (ValidationException $e) {
            // Manejar los errores de validación aquí
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $imagen =  $request->file('file')->store('public');
        $url = Storage::url($imagen);

        $producto = Producto::create(
            [
                'name' => Str::upper($request->name),
                'price' => $request->price,
                'slug' => $request->name,
                'description' => $request->description,
                'category_id' => 1,
                'image_path' => $url,
                'alias' => $request->alias,
                'visitas' => 0
            ]
        );

        return redirect()->route('productos.index');
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
        // dd($id);
        $producto = Producto::find($id);
        $materiales = Material::all();
        // dd($producto);
        return view('producto.show', compact('producto', 'materiales'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return view('producto.edit', compact('id'));

        $producto = Producto::find($id);
        return view('producto.edit', ['producto' => $producto]);
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


        if ($request->file('file') == null) {

            // sino $url toma el valor que tenia imagen_path cuando no se actualiza la foto
            $p = Producto::find($request->id);
            $url = $p->image_path;
        } else {
            // si actualiza debe pasar ...
            $imagen =  $request->file('file')->store('public');
            $url = Storage::url($imagen);
        }

        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'price' => 'required|numeric|min:0|max:100000',
                'alias' => [
                    'required', 'string', 'max:255', Rule::unique('productos', 'alias')->ignore($request->id)
                ],
                // 'description' => ['required', 'string'],
                'description' => ['string', 'max:255'],
                'file' => ['file', 'mimes:jpeg,png', 'max:2048']

            ]);
        } catch (ValidationException $e) {
            // dd($e);
            // Manejar los errores de validación aquí
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        Producto::find($request->id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'slug' => $request->name,
            'description' => $request->description,
            'category_id' => 1,
            'image_path' => $url,
            'alias' => $request->alias
        ]);

        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        //elimina pero falta la vista 
        // return "borrado";
        return redirect()->route('productos.index');
    }

    //idea manejar con otra funcion la parte del detalle de productos
    public function detalle($id)
    {

        $pro = Producto::find($id);
        // Incrementa el valor del campo 'cantidad' en 1
        $pro->increment('visitas');

        // Guarda los cambios en la base de datos
        $pro->save();

        $url_imagen = '';
        return view('detalleProducto', compact('pro', 'url_imagen'));
    }

    public function buscarProducto()
    {
        $buscar = request()->get('buscar', '');
        $producto = Producto::all();

        if (request()->has('buscar')) {
            $busqueda = Producto::where('name', 'like', '%' . $buscar . '%')->get();
        }
        return view('producto.busqueda', compact('busqueda'));
    }
}
