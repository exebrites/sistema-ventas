<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Pedido;
use App\Models\Disenio;
use App\Models\Pregunta;
use App\Mail\EstadoMailable;
use Illuminate\Http\Request;
use App\Mail\DisenoRealizado;
use App\Models\DetallePedido;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PedidoController;

class DisenioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "abort";
        // $disenios = Disenio::all();
        // $pedidos = Pedido::all();
        // return view('disenio.index', ['disenios' => $disenios, 'pedidos' => $pedidos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // return view('disenio.create');
        return "abort";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return "abort";
        return $request;
        // try {

        //     $request->validate([


        //     ]);
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }

        $imagen =  $request->file('file')->store('public');
        // $url = Storage::url($imagen);
        $url_imagen = "null";
        $url_disenio =  Storage::url($imagen);;
        $diseno_estado = true;

        Disenio::create([
            'detallePedido_id' => 7,
            'url_imagen' => $url_imagen,
            'url_disenio' => $url_disenio,
            'disenio_estado' => $diseno_estado
        ]);

        // Mail::to('exe@gmail.com')->send(new EstadoMailable);

        return redirect()->route('disenios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disenio = Disenio::find($id);
        $fecha_inicio = $disenio->detallePedido->pedidos->fecha_inicio;
        if ($fecha_inicio != null) {
            $fecha =  Carbon::parse($fecha_inicio);
            $fecha_inicio = $fecha->format('d-m-Y');
        }
        return view('disenio.show', compact('disenio', 'fecha_inicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "abort";
        $disenio = Disenio::find($id);
        // se envia a update
        return view('disenio.edit', ['disenio' => $disenio]);
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
        return "abort";
        $disenio = Disenio::find($id);
        $pedido = $disenio->detallePedido->pedidos;
        $pedido->update(['estado' => 'disenio']);


        /**
       mueve la imagen a public storage
         *   $imagen =  $request->file('file')->store('public');
        cambia el nombre de la imagen para poder subirla a una DB
         *   $url = Storage::url($imagen);
         */

        $imagen =  $request->file('file')->store('public');
        // // // $url = Storage::url($imagen);
        if ($imagen != null) {

            $url_imagen = null;
            $url_disenio =  Storage::url($imagen);;
            $diseno_estado = true;
            $disenio = Disenio::find($id);
            $disenio->update([
                // 'url_imagen' => $url_imagen,
                'url_disenio' => $url_disenio,
                'disenio_estado' => $diseno_estado
            ]);
        }


        // Mail::to('exe@gmail.com')->send(new EstadoMailable);

        return redirect()->route('disenios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "abort";
        return "borrando";
        // $disenio = Disenio::find($id);
        // $disenio->update(['url_disenio' => ""]);

        // return redirect()->route('disenios.index');
    }

    /**
     * Método para descargar una imagen a partir de su ID.
     *
     * @param int $id - El ID de la imagen que se desea descargar.
     * @return \Illuminate\Http\Response - Una respuesta HTTP que contiene la imagen para su descarga.
     */

    public function descargar(Request $request)
    {
        // return $request;
        $descarga = $request->archivo;
        $id = $request->id;
        // Paso 1: Obtener la URL de la imagen a partir del ID proporcionado.
        $img = Disenio::where('id', $id)->value($descarga);
        // dd($img);
        // Paso 2: Crear la URL completa a la ubicación de la imagen en el servidor.
        $path = "/home/exe/repo_trabajo_final/public";
        $url_full = $path . $img;

        // Paso 3: Generar una respuesta HTTP que permite la descarga de la imagen.
        return response()->download($url_full);
    }

    public function show_disenio($id)
    {

        // return "aqui";
        $disenio = Disenio::find($id);
        $preguntas = Pregunta::all();
        return view('disenio.indexCliente', compact('disenio', 'preguntas'));
    }

    public function actualizar_disenio(Request $request)
    {



        // vista DETALLE DE DISEÑO show


        // cuando el campo borrar sea igual a 1 se actualiza el diseño. Esta asociado al btn Borrar 


        // cuando el campo borrar sea igual a 0 se actualiza el diseño con la imagen que se suba (DISEÑO). Esta asociado al btn Subir

        // return "actualizar";

        // return $request;
        if ($request->borrar == "1") {
            $disenio = Disenio::find($request->id);
            $disenio->update(['url_disenio' => "", 'disenio_estado' => 0]);
        } elseif ($request->borrar == "0") {
            # code...
            $imagen =  $request->file('file')->store('public');
            $url = Storage::url($imagen);
            $disenio = Disenio::find($request->id);
            $disenio->update([
                'url_disenio' =>   $url,
                'disenio_estado' => 1
            ]);
        }

        return redirect()->back();
    }
    public function revision_disenio($id)
    {
        // return "revision";
        // una vez enviado para revision no se puede cargar mas diseños 

        // Cuando Disenio->revision sea igual a 0 significa que se envió al cliente 

        // Cuando Disenio->revision sea igual a 1 significa que el cliente vió el Diseño, lo califico y lo mando a revision. Disconformidad 


        $disenio = Disenio::find($id);
        $disenio->update(['revision' => 0]);
        $pedido =  $disenio->detallePedido->pedidos;
        $producto = $disenio->detallePedido->producto;
        $cliente = $pedido->cliente;
        $empresa = config('contacto.nombre');
        Mail::to($cliente->correo)->send(new DisenoRealizado($pedido, $producto, $cliente, $empresa));
        return redirect()->route('pedidos.show', $pedido->id)->with('msg_success', 'Diseño cargado con éxito');
    }
}
