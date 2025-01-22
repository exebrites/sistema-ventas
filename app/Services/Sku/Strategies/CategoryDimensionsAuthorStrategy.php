<?php

namespace App\Services\Sku\Strategies;

use App\Services\Sku\Strategies\SkuGenerationStrategy;


class CategoryDimesionAuthorStrategy implements SkuGenerationStrategy
{

    public function generateSku(array $attributes): string
    {
        return "{$attributes['category']}-{$attributes['dimensions']}-{$attributes['author']}-{$attributes['id']}";
    }
}
