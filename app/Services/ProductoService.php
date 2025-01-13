<?php

namespace App\Services;

use App\Models\Producto;

class ProductoService
{

    public function control_stock($producto)
    {
        $productoDB = Producto::find($producto->id);
        if (!$productoDB) {
            return back()->withErrors(['error' => 'El producto no existe.']);
        }
        if ($producto->quantity > $productoDB->stock) {
            return back()->withErrors(['error' => 'El producto no tiene stock suficiente.']);
        }
        $productoDB->decrement('stock', $producto->quantity);
    }
}
