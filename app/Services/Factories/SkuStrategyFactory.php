<?php

namespace App\Services\Factories;

use App\Services\Sku\Strategies\SkuGenerationStrategy;
use App\Services\Sku\Strategies\CategoryMaterialColorStrategy;
use App\Services\Sku\Strategies\CategoryDimensionsAuthorStrategy;
use invalidArgumentException;
class SkuStrategyFactory
{
    public static function create(array $attributes): SkuGenerationStrategy
    {
        if (isset($attributes['material']) && isset($attributes['color'])) {
            return new CategoryMaterialColorStrategy();
        }
        if (isset($attributes['dimensions']) && isset($attributes['author'])) {
            return new CategoryDimensionsAuthorStrategy();
        }

        throw new InvalidArgumentException('No valid strategy found for the given attributes.');
    }
}
