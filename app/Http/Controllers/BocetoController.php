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
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Puedes ajustar los tipos de archivos y el tamaño máximo
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nombre' => 'required|string|max:255',
            'objetivo' => 'required|string',
            'publico' => 'required|string',
            'contenido' => 'required|string',
        ]);

        if ($request->logo) {
            $img_logo =  $request->file('logo')->store('public');
            $url_logo = Storage::url($img_logo);
        } else {
            $img_logo = "";
        }


        if ($request->logo) {
            $img_img =  $request->file('img')->store('public');
            $url_img = Storage::url($img_img);
        } else {
            $url_img = "";
        }

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

        // return $request;
        $descarga = $request->archivo;
        $id = $request->id;
        // Paso 1: Obtener la URL de la imagen a partir del ID proporcionado.
        $img = Boceto::where('id', $id)->value($descarga);

        $path = "/home/exe/repo_trabajo_final/public";

        // Paso 2: Crear la URL completa a la ubicación de la imagen en el servidor.
        $url_full = $path . $img;

        // Paso 3: Generar una respuesta HTTP que permite la descarga de la imagen.
        return response()->download($url_full);
    }
}
