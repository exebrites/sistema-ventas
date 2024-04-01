<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\DetallePedido;

class TuPedidoController extends Controller
{
    public function verpedidos($pedido_id)
    {
        $pedido =  Pedido::find($pedido_id);

        $fecha =  Carbon::parse($pedido->fecha_inicio);
        $pedido->fecha_inicio = $fecha->format('d-m-Y');

        $fecha =  Carbon::parse($pedido->fecha_entrega);
        $pedido->fecha_entrega = $fecha->format('d-m-Y');

        
        return view('pedido.cliente.verpedido', compact('pedido'));
    }

    public function verDisenio($detalle_id)
    {

        $detalle = DetallePedido::find($detalle_id);


        dd($detalle);
        return view('pedido.cliente.verdisenio', compact('detalle'));
    }
}
