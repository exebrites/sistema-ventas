<?php

namespace App\Services;

use App\Contracts\ShoppingCartInterface;
use Illuminate\Support\Collection;

class ShoppingCartService implements ShoppingCartInterface
{
    public function getTotal(): float
    {
        return \Cart::getTotal();
    }

  
    public function getContent():Collection
    {
        return \Cart::getContent();
    }
    public function getItem($id): ?object
    {
        return \Cart::get($id);
    }

    public function clear(): void
    {
        \Cart::clear();
    }
    public function remove ($id): void
    {
        \Cart::remove($id);
    }
    public function add (array $data): void //dudoso 
    {
        \Cart::add($data);
    }
    public function update ($id, array $data): void
    {
        \Cart::update($id, $data);
    }
}
