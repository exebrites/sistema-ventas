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


        // si revision igual a 0 el cliente solicita una revision del diseño 
        $disenio_id = $request->disenio_id;
        $comentario = $request->comentario;
        $revision = $request->revision;


        // si revision igual 1 entonces el cliente esta contendo y pedido sigue al siguiente estado 

        # code...

        // $pregunta = Pregunta::where('contenido', 'comentario')->get('id');
        // Respuesta::create([
        //     'pregunta_id' => $pregunta[0]->id,
        //     'disenio_id' => $disenio_id,
        //     'contenido_respuesta' => $comentario
        // ]);
        // $request = $request->except(['_token', 'disenio_id', 'comentario', 'revision']);
        // foreach ($request as $pregunta_id => $valor) {
        //     $respuesta = Respuesta::create([
        //         'pregunta_id' => $pregunta_id,
        //         'disenio_id' => $disenio_id,
        //         'contenido_respuesta' => $valor
        //     ]);
        // }


        if ($revision) {
            return "cliente contento";
        } else {
            return "diseño a revision";
        }

        $disenio = Disenio::find($disenio_id);
        $disenio->update(['revision' => $revision]);
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
