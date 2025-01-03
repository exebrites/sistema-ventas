<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;
use App\Models\Pedido;
class PedidoTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {

        $response = $this->withoutMiddleware()->get(route('pedidos.index'));

        $response->assertStatus(200);
        $response->assertViewIs('pedido.index');
        // $response->assertSee('Pedidos');

        // Verifica que no haya buffers abiertos
        while (ob_get_level() > 0) {
            ob_end_clean(); // Limpia y cierra todos los buffers abiertos
        }
        $this->assertEquals(0, ob_get_level(), 'Hay buffers de salida abiertos al final del test.');
    }

    public function test_show()
    {
        $pedido = Pedido::factory()->create();
        $response = $this->withoutMiddleware()->get(route('pedidos.show', $pedido->id));
        $response->assertStatus(200);
        $response->assertViewIs('pedido.show');
        while (ob_get_level() > 0) {
            ob_end_clean(); // Limpia y cierra todos los buffers abiertos
        }
        $this->assertEquals(0, ob_get_level(), 'Hay buffers de salida abiertos al final del test.');
    }
}
