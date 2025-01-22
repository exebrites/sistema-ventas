<?php
namespace App\Services\Sku\Strategies;

use App\Services\Sku\Strategies\SkuGenerationStrategy;

class CategoriaNombreLoteStrategy implements SkuGenerationStrategy
{
    public function generateSku(array $attritutes): string
    {
        return "{$attritutes['category']}-{$attritutes['nombre']}-{$attritutes['lote']}";
    }
}