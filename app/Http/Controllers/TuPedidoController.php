<?php

namespace App\Http\Controllers;

use App\Models\CostoDisenio;
use Carbon\Carbon;
use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\DetallePedido;

class TuPedidoController extends Controller
{
    public function verpedidos($pedido_id)
    {
        $pedido =  Pedido::find($pedido_id);

        if ($pedido->fecha_inicio) {
            $fecha =  Carbon::parse($pedido->fecha_inicio);
            $pedido->fecha_inicio = $fecha->format('d-m-Y');
        }

        $fecha =  Carbon::parse($pedido->fecha_entrega);
        $pedido->fecha_entrega = $fecha->format('d-m-Y');

        $costoDisenio = CostoDisenio::find(1);

        return view('pedido.cliente.verpedido', compact('pedido', 'costoDisenio'));
    }

    public function verDisenio($detalle_id)
    {

        $detalle = DetallePedido::find($detalle_id);


        dd($detalle);
        return view('pedido.cliente.verdisenio', compact('detalle'));
    }
}
