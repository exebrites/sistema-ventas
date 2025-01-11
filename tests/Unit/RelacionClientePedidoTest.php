<?php

namespace Tests\Unit;

use App\Models\Estado;
use PHPUnit\Framework\TestCase;
use Illuminate\Database\QueryException;
use App\Models\Pedido;

class RelacionClientePedidoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->expectException(QueryException::class);

        $estado= Estado::create(['nombre' => 'nuevo']);
        Pedido::create(

            [
                'clientes_id' => null,
                'fecha_inicio' => null,
                'fecha_entrega' => null,
                'estado_id' => $estado->id,
                'costo_total' => 100
            ]

        );
    }
}
