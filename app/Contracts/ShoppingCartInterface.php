<?php

namespace App\Contracts;

interface ShoppingCartInterface
{
    public function getTotal(): float;

    public function getContent(): array;

    public function getItem($id): ?object;

    public function clear(): void;
}
