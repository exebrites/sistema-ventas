<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use App\Models\Disenio;
use App\Models\Pregunta;
use App\Models\Respuesta;
use Illuminate\Http\Request;

class RespuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request;
        // 3,4,5 y 26

        $disenio_id = $request->disenio_id;
        $comentario = $request->comentario;
        $revision = $request->revision;

        $pregunta = Pregunta::where('contenido', 'comentario')->get('id');
        // $respuesta = $respuestas->where('pregunta_id', 3)->where('disenio_id', 26)->get();


        Respuesta::create([
            'pregunta_id' => $pregunta[0]->id,
            'disenio_id' => $disenio_id,
            'contenido_respuesta' => $comentario
        ]);

        // Excluye algunos campos del formulario que no se almacenarán en la base de datos.
        // En este caso, excluye '_token' y 'disenio_id'.
        $request = $request->except(['_token', 'disenio_id', 'comentario', 'revision']);
        // return $request;
        // Itera sobre los campos restantes del formulario y crea registros en la base de datos.
        foreach ($request as $pregunta_id => $valor) {
            // Para cada campo, crea un nuevo registro utilizando el modelo 'Respuesta'.
            $respuesta = Respuesta::create([
                'pregunta_id' => $pregunta_id,
                'disenio_id' => $disenio_id,
                'contenido_respuesta' => $valor
            ]);
            // return $respuesta;
        }
        // $disenio = Disenio::find($disenio_id);
        // $disenio->detallePedido->update(['produccion' => true]);

        $disenio = Disenio::find($disenio_id);
        $disenio->update(['revision' => $revision]);
        // $detalle = $disenio->detallePedido;
        // si produccion es verdadero hace pasaje a produccion de lo contrario sigue en diseño
        // $detalle->update(['produccion' => $revision]);
        return redirect()->route('shop');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
