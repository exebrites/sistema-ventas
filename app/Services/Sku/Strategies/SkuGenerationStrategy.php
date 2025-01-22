<?php

namespace App\Services\Sku\Strategies;

interface SkuGenerationStrategy
{

    public function generateSku(array $attritutes): string;
}
