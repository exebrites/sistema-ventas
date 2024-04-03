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

        // En cualquiera de los casos se guardan las respuestas relacionadas al diseño


        $disenio_id = $request->disenio_id;
        $comentario = $request->comentario;
        $campoRevision = $request->revision;



        $pregunta = Pregunta::where('contenido', 'comentario')->get('id');
        Respuesta::create([
            'pregunta_id' => $pregunta[0]->id,
            'disenio_id' => $disenio_id,
            'contenido_respuesta' => $comentario
        ]);
        $request = $request->except(['_token', 'disenio_id', 'comentario', 'revision']);
        foreach ($request as $pregunta_id => $valor) {
            $respuesta = Respuesta::create([
                'pregunta_id' => $pregunta_id,
                'disenio_id' => $disenio_id,
                'contenido_respuesta' => $valor
            ]);
        }

        $disenio = Disenio::find($disenio_id);
        $detalle = $disenio->detallePedido;

        // dd($detalle);
        $pedido_id = $detalle->pedido_id;
        if ($campoRevision == 1) {
            /** cuando el campo revision es igual a 1 = SI
             *      cliente conforme. Producto listo para siguiente etapa 
             *          detallePedido->produccion debe valer 1              
             */
            $detalle->update(['produccion' => 1]);

            return redirect()->route('verpedidos', $pedido_id)->with('msg_success', 'Gracias por confirmar el diseño. Proximamente estaremos en contacto con usted.');
        } else {
            /** cuando campo revision es igual a 0 =  NO
             *      Cliente disconforme. Producto vuelve a recorrer el flujo principal             
             *          disenio->revision 1
             */
            $disenio->update([
                'revision' => 1
            ]);
            return redirect()->route('verpedidos', $pedido_id)->with('msg_success', 'Gracias por confirmar el diseño. Proximamente estaremos en contacto con usted.DISEÑO A REVISION.');
        }
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
