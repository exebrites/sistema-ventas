<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\CostoDisenio;

class CostoDisenioTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_costo_total_disenio()
    {
        //Bloque de tres 
        // 1. Dado -> datos
        $productos = [
            (object) ['attributes' => ['costo_disenio' => 100],],
            (object) ['attributes' => ['costo_disenio' => 100],]
        ];
        // 2.Cuando 
        $costoDisenio = new CostoDisenio();
        $response  =  $costoDisenio->costo_total_disenio($productos);
        // 3. Entonces
        $this->assertEquals(200, $response);
    }


    public function test_costo_disenio()
    {
        // 1. Dado

        // 2. Cuando

        // 3. Entonces
        $this->assertTrue(true);
    }

    public function test_determinar_costo_cobrar_portecentaje_igual_costo_hs()
    {
        // 1. Dado
        $costo_porcentaje = 100;
        $costo_hs = 100;
        // 2. Cuando
        $costoDisenio = new CostoDisenio();
        $response = $costoDisenio->determinarCostoCobrar($costo_porcentaje, $costo_hs);
        // 3. Entonces
        $this->assertTrue($response);
    }
}
