<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PedidoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->post(route('procesarPedido.procesar'), [
            'fechaEntrega' => '2025-01-10'
        ]);

        $response->assertRedirect(route('pedido-detallePedido'))->assertStatus(302);
    }
}
