<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use App\Models\Pedido;
use Illuminate\Http\Request;

class TuPedidoController extends Controller
{
    public function verpedidos($pedido_id)
    {
        $pedido =  Pedido::find($pedido_id);
        return view('pedido.cliente.verpedido', compact('pedido'));
    }

    public function verDisenio($detalle_id)
    {

        $detalle = DetallePedido::find($detalle_id);

        return view('pedido.cliente.verdisenio', compact('detalle'));
    }
}
