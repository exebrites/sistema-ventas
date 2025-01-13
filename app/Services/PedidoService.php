<?php

namespace App\Services;

use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use App\Models\DetallePedido;




class PedidoService
{

    public function crearPedido($cliente, $productos)
    {
        return DB::transaction(function () use ($cliente, $productos) {
            // Crear pedido
            $pedido = Pedido::create([
                'clientes_id' => $cliente->id,
                'fecha_inicio' => now(),
                'fecha_entrega' => null,
                'estado_id' => 1,
                'costo_total' => \Cart::getTotal(),
            ]);

            // Crear detalles del pedido
            foreach ($productos as $producto) {
                DetallePedido::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $producto->quantity,
                    'subtotal' => \Cart::get($producto->id)->getPriceSum(),
                ]);
            }

            return $pedido;
        });
    }
}
