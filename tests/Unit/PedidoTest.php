<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Producto;

class PedidoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_total()
    {
        // $this->assertTrue(true);
        Producto::create([
            'nombre' => 'producto 1',
            'precio' => 100,
            'cantidad' => 10
        ]);
        $pedido = new Pedido();

        DetallePedido::create([
            'pedido_id' => $pedido->id,
            'producto_id' => 1,
            'cantidad' => 1,
            'subtotal' => 100
        ]);
    }
}
