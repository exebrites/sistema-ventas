<?php

namespace App\Services\Factories;

use App\Services\Sku\Strategies\SkuGenerationStrategy;
use App\Services\Sku\Strategies\CategoryMaterialColorStrategy;
use App\Services\Sku\Strategies\CategoryDimensionsAuthorStrategy;
use App\Services\Sku\Strategies\NombreMarcaTamanioSkuStrategy;
use invalidArgumentException;

class SkuStrategyFactory
{
    public static function create(array $attributes): SkuGenerationStrategy
    {       // F1: CATEGORÍA-MATERIAL-COLOR-AÑO-ID
        if (isset($attributes['material']) && isset($attributes['color'])  && isset($attributes['year'])) {
            return new CategoryMaterialColorStrategy();
        }
        //F2:NOMBRE-MARCA-TAMAÑO-SKU
        if (isset($attributes['marca']) && isset($attributes['tamanio'])) {

            return new NombreMarcaTamanioSkuStrategy();
        }
        //F3:CAT-DIM-AUTOR-ID

        if (isset($attributes['dimensions']) && isset($attributes['author'])) {
            return new CategoryDimensionsAuthorStrategy();
        }

        // F4: CATEGORÍA-NOMBRE-ID
        throw new InvalidArgumentException('No valid strategy found for the given attributes.');
    }
}
