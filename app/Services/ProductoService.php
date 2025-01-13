<?php

namespace App\Services;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class ProductoService
{

    public function control_stock($producto, $cantidad)
    {

        // Validar que la cantidad sea positiva
        if ($cantidad <= 0) {
            return 'La cantidad debe ser mayor a cero.';
        }
        // Validar que el producto existe en la base de datos
        $productoDB = Producto::find($producto->id);
        if (!$productoDB) {
            return 'El producto no existe.';
        }

        // Validar el stock disponible
        if ($cantidad > $productoDB->stock) {
            return 'El producto no tiene stock suficiente.';
        }

        DB::transaction(function () use ($productoDB, $cantidad) {
            $productoDB->decrement('stock', $cantidad);
        });
        return true; // Operación exitosa
    }
}
