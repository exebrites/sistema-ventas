<?php

namespace App\Services\Sku;

use App\Services\Sku\Strategies\SkuGenerationStrategy;

class SkuGenerator
{
    private SkuGenerationStrategy $strategy;
    public function __construct(SkuGenerationStrategy $strategy)
    {
        $this->strategy  = $strategy;
    }
    public function generate(array $attributes): string
    {
        return $this->strategy->generateSku($attributes);
    }
}
