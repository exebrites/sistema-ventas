<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\DetallePedido;
use App\Models\Estado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class PedidoTest extends TestCase
{
    use RefreshDatabase; // Limpia la base de datos en cada prueba.

    /** @test */
    public function it_can_format_fecha_entrega_correctly()
    {
        // Arrange: Crear un pedido con una fecha específica.
        $pedido = Pedido::factory()->create([
            'fecha_entrega' => '2025-01-11',
        ]);

        // Act: Obtener el atributo formateado.
        $formattedDate = $pedido->fecha_entrega;

        // Assert: Verificar el formato.
        $this->assertEquals('11-01-2025', $formattedDate);
    }

    /** @test */
    public function it_can_calculate_total_correctly()
    {
        // Arrange: Crear un pedido con detalles.
        $pedido = Pedido::factory()->create();
        DetallePedido::factory()->create([
            'pedido_id' => $pedido->id,
            'subtotal' => 100,
        ]);
        DetallePedido::factory()->create([
            'pedido_id' => $pedido->id,
            'subtotal' => 200,
        ]);

        // Act: Calcular el total.
        $total = $pedido->getTotal();

        // Assert: Verificar el total.
        $this->assertEquals(300, $total);
    }

    /** @test */
    public function scope_activo_returns_active_pedidos()
    {
        // Arrange: Crear pedidos con diferentes estados.
        Pedido::factory()->create(['estado_id' => 10]); // Activo
        Pedido::factory()->create(['estado_id' => 11]); // Inactivo

        // Act: Llamar al scope.
        $activos = Pedido::activo()->get();

        // Assert: Verificar que solo se devuelven los pedidos activos.
        $this->assertCount(1, $activos);
        $this->assertEquals(10, $activos->first()->estado_id);
    }

    /** @test */
    public function scope_pedidos_cliente_returns_client_orders()
    {
        // Arrange: Crear un cliente y sus pedidos.
        $cliente = Cliente::factory()->create();
        Pedido::factory()->create(['clientes_id' => $cliente->id]);
        Pedido::factory()->create(['clientes_id' => $cliente->id]);
        Pedido::factory()->create(); // Pedido de otro cliente.

        // Act: Llamar al scope.
        $pedidosCliente = Pedido::pedidosCliente($cliente->id)->get();

        // Assert: Verificar que se devuelven solo los pedidos del cliente.
        $this->assertCount(2, $pedidosCliente);
        foreach ($pedidosCliente as $pedido) {
            $this->assertEquals($cliente->id, $pedido->clientes_id);
        }
    }

    /** @test */
    public function relaciones_estan_correctamente_definidas()
    {
        // Arrange: Crear un pedido con relaciones.
        $estado = Estado::factory()->create();
        $cliente = Cliente::factory()->create();
        $pedido = Pedido::factory()->create([
            'estado_id' => $estado->id,
            'clientes_id' => $cliente->id,
        ]);
        DetallePedido::factory()->create(['pedido_id' => $pedido->id]);

        // Act & Assert: Verificar relaciones.
        $this->assertInstanceOf(Estado::class, $pedido->estado);
        $this->assertInstanceOf(Cliente::class, $pedido->cliente);
        $this->assertCount(1, $pedido->detallesPedido);
    }
}
