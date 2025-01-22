<?php

namespace App\Services\Sku\Strategies;

use App\Services\Sku\Strategies\SkuGenerationStrategy;

class NombreMarcaTamanioSkuStrategy implements SkuGenerationStrategy
{

    public function generateSku(array $attritutes): string
    {

        return "{$attritutes['nombre']}{$attritutes['marca']}-{$attritutes['tamanio']}-{$attritutes['lote']}";
    }
}
