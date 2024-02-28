<?php

namespace App\Http\Controllers;

use App\Models\Comprobante;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComprobanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $pedidos = Pedido::where('estado', 'pendiente-pago')->get();
        // $pedidos->comprobantes;
        $comprobantes = Comprobante::all();
        // $comprobantes = $comprobantes->pedido->where('estado', 'pendiente-pago')->get();
        return view('comprobante.index', ['comprobantes' => $comprobantes]);
        // return $comprobantes;

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

        try {
            // dd($request);
            $id = $request->id;
            $imagen =  $request->file('comprobante')->store('public');
            // $estado = $request->estado;
            //cambia el nombre de la imagen para poder subirla a una DB
            $url = Storage::url($imagen);
            // dd($url);
            $comprobante = Comprobante::create([
                'pedido_id' => $id,
                'url_comprobantes' => $url,
            ]);
            // dd($comprobante);
            return redirect()->route('shop')->with('success_msg', 'Su comprobante ha sido subido espere a que se confirme el pago!');
            // return   $estado;


        } catch (\Exception $e) {
            // Captura la excepción y maneja el error
            if ($e->getCode() == '45000') {
                // La excepción fue lanzada por el trigger
                // $mensajeError = $e->getMessage();
                $mensajeError = "Tuvimos un problema al subir el comprobante, ingrese nuevamente";
                return redirect()->route('checkout.show', $id)->with('mensajeError',  $mensajeError);
            } else {
                // La excepción no fue lanzada por el trigger, maneja de otra manera
                return response()->json(['error' => 'Error desconocido'], 500);
            }
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
        $comprobante = Comprobante::find($id);
        return view('comprobante.show', compact('comprobante'));
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
