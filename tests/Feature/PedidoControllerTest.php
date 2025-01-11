<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PedidoControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_procesar_pedido()
    {
        $response = $this->post(route('procesarPedido.procesar'), [
            'id' => 1,
            'costo' => 100
        ]);

        $response->assertStatus(302);
        $response->assertViewHas('checkout');
        // $response->assertRedirect(route('pedido-detallePedido'));
    }
}
