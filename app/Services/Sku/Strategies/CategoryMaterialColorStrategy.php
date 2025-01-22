<?php

namespace App\Services\Sku\Strategies;

use App\Services\Sku\Strategies\SkuGenerationStrategy;

class CategoryMaterialColorStrategy implements SkuGenerationStrategy
{

    public function generateSku(array $attributes): string{

      return "{$attributes['category']}-{$attributes['material']}-{$attributes['color']}-{$attributes['year']}-{$attributes['id']}";
    }
}
