<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pedido;
use App\Models\Producto;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ContactoController;
use App\Models\CostoDisenio;
use Illuminate\Validation\ValidationException;
use  App\Http\Requests\CartAddResquest;

class CartController extends Controller
{
    public function shop()
    {
        $products = Producto::where('activo', true)->orderBy('visitas', 'desc')->paginate(8); //scope visitas
        return view('shop', compact('products'));
    }
    public function cart()
    {
        $cartCollection = \Cart::getContent();
        // $costo = CostoDisenio::costo_total_disenio($cartCollection);
        $costo  = 0;
        return view('cart')->with(['cartCollection' => $cartCollection, 'costo'  => $costo]);
    }
    public function remove(Request $request)
    {
        \Cart::remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'Producto removido!');
    }

    private function cargarImagen($request, $input = 'file')
    {

        // Sube el archivo recibido en la solicitud con el nombre 'file' al directorio 'public' del sistema de archivos de Laravel.
        $imagen = $request->file($input)->store('public');

        // Obtiene la URL pública del archivo recién almacenado utilizando el servicio Storage de Laravel.
        return  Storage::url($imagen);
        //agrega el producto y su diseño al carrito

        // dd("disenio asistido");
    }
    public function add(CartAddResquest $request)
    {
        //configurar el disenio cargado 
        // $url_imagen = $this->cargarImagen($request);
        $url_imagen = "null";
        $disenio_estado = true;
        //determinar el costo de diseño
        // $costo_disenio = CostoDisenio::find(1); //en db
        // $costo_disenio_asistido = $costo_disenio->costo_disenio($request->price, $request->quantity, $disenio_estado,);
        $costo_disenio_asistido = 0;
        // agreaga el producto y su disenio al carrito
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'imagen_path' => $request->img,
                'slug' => $request->slug,
                'url_disenio' => $url_imagen,
                'disenio_estado' => $disenio_estado,
                'costo_disenio' => $costo_disenio_asistido
            )
        ));

        return redirect()->route('cart.index')->with('success_msg', 'Producto agregado a su Carrito!');
    }

    public function add_boceto(Request $request)
    {
        //configurar logo e imagenes
        $url_logo =  $request->logo ? $this->cargarImagen($request, 'logo') : "";
        $url_img =  $request->img ? $this->cargarImagen($request, 'img') : "";
        //agrega el producto y su diseño al carrito
        $disenio_estado = false;
        $costo_disenio = CostoDisenio::find(1); //en db
        $costo_disenio_completo = $costo_disenio->costo_disenio($request->price, $request->quantity, $disenio_estado);
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'imagen_path' => $request->img_path,
                "nombre" => $request->nombre,
                "objetivo" => $request->objetivo,
                "publico" => $request->publico,
                "contenido" => $request->contenido,
                "logo" => $url_logo,
                "img" => $url_img,
                "disenio_estado" => $disenio_estado, // $request->disenio_estado
                'costo_disenio' => $costo_disenio_completo
            )
        ));

        return redirect()->route('cart.index')->with('success_msg', 'Producto agregado a su Carrito!');
    }

    public function update(Request $request)
    {

        // dd("");
        \Cart::update(
            $request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
            )
        );
        $p = \Cart::get($request->id);
        $precio  = $p->price;
        $cantidad = $p->quantity;
        $disenio_estado = $p->attributes['disenio_estado'];
        $imagen_path =  $p->attributes['imagen_path'];

        // dump($p);
        // dd("");

        if ($p->attributes['disenio_estado']) {

            $url_disenio = $p->attributes['url_disenio'];

            // $costo = CostoDisenio::costo_disenio($precio, $cantidad, $disenio_estado);
            $costo = 0;
            \Cart::update(
                $request->id,
                array(
                    'attributes' => array(
                        "imagen_path" => $imagen_path,
                        "slug" => "Carpetas de Presentación",
                        "url_disenio" => $url_disenio,
                        "disenio_estado" => true,
                        "costo_disenio" => $costo

                    )
                )
            );
        } else {

            // $costo = CostoDisenio::costo_disenio($precio, $cantidad, $disenio_estado);
            $costo = 0;
            $nombre = $p->attributes['nombre'];
            $objetivo =  $p->attributes['objetivo'];
            $publico = $p->attributes['publico'];
            $contenido = $p->attributes['contenido'];
            $logo   = $p->attributes['logo'];
            $img = $p->attributes['img'];
            \Cart::update(
                $request->id,
                array(
                    'attributes' => array(
                        "imagen_path" => $imagen_path,
                        "nombre" => $nombre,
                        "objetivo" => $objetivo,
                        "publico" => $publico,
                        "contenido" => $contenido,
                        "logo" => $logo,
                        "img" => $img,
                        "disenio_estado" => false,
                        "costo_disenio" => $costo

                    )
                )
            );
        }

        return redirect()->route('cart.index')->with('success_msg', 'Carrito actualizado!');
    }

    public function clear()
    {
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Carrito borrado!');
    }
}
