<?php

namespace App\Contracts;
use Illuminate\Support\Collection;
interface ShoppingCartInterface
{
    public function getTotal(): float;

    public function getContent(): Collection; //cuidaodo

    public function getItem($id): ?object;

    public function clear(): void;

    public function remove($id): void;

    public function add(array $data): void;

    public function update($id, array $data): void;
}
