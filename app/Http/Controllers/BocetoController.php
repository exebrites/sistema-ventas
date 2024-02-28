<?php

namespace App\Http\Controllers;

use App\Models\Boceto;
use App\Models\Disenio;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BocetoController extends Controller
{
    function index()
    {
        $bocetos = Boceto::all();
        return view('boceto.index', ['bocetos' => $bocetos]);
    }
    function store(Request $request)
    {
        // return $request;
        // ---------------------------------
        $img_logo =  $request->file('logo')->store('public');
        $url_logo = Storage::url($img_logo);

        // // ------------------------
        $img_img =  $request->file('img')->store('public');
        $url_img = Storage::url($img_img);


        Boceto::create([
            'negocio' => $request->nombre,
            'objetivo' => $request->objetivo,
            'publico' => $request->publico,
            'contenido' => $request->contenido,
            'url_logo' => $url_logo,
            'url_img' => $url_img
        ]);

        return back()->with('success_msg', 'Se cargó con exito la informacion para crear un boceto, pronto nos comunicaremos con usted !Todavia su producto no fue agregado al carrito ');
    }
    function create(Request $request, $id)
    {
        // return $id;
        $pro = Producto::find($id);
        // dd($producto);
        return view('boceto.create', compact('pro'));
        // return $request;
    }
    public  function show($id)
    {
        $boceto = Boceto::find($id);
        // return $boceto;
        return view('boceto.show', compact('boceto'));
    }
    public function descargar_boceto(Request $request)
    {

        $descarga = $request->archivo;
        $id = $request->id;
        // Paso 1: Obtener la URL de la imagen a partir del ID proporcionado.
        $img = Boceto::where('id', $id)->value($descarga);

        // Paso 2: Crear la URL completa a la ubicación de la imagen en el servidor.
        $url_full = "D:\TF-SGPO\Sist-Oliva\public" . $img;

        // Paso 3: Generar una respuesta HTTP que permite la descarga de la imagen.
        return response()->download($url_full);
    }
}
