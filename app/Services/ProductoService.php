<?php

namespace App\Services;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class ProductoService
{

    private function categoria($producto)
    {
        $tituloCategoria  = $producto->categoria->titulo;
        $inicioTitulo = substr($tituloCategoria, 0, 3);
        return strtoupper($inicioTitulo);
    }
    public function generarSkuFormato1($producto)
    {
        // CATEGORÍA-MATERIAL-COLOR-AÑO-ID
        // WSHD-PL-SB-2010-0001


    }
    public function generarSkuFormato2($producto)
    {
        // Estructura: NOMBRE-MARCA-TAMAÑO-SKU
        // Ejemplo:
        // SOLBERG-MURH-GRA-79204347
    }
    public function generarSkuFormato3($producto)
    {
        //         Estructura: SUBCAT-DIM-PÚBLICO-ID
        // Ejemplo:
        // FHFM-3213x137558x75090-1-295
    }
    public function generarSkuFormato4($producto)
    { //generacion de sku apartir de la categoria,nombre y numero secuencia lote
        $tituloCategoria  = $producto->categoria->titulo;
        $inicioTitulo = substr($tituloCategoria, 0, 3);
        $inicioNombreProducto  = substr($producto->nombre, 0, 3);
        $numeroLote = (string)$producto->id;
        if (($producto->id) < 10) {
            $numeroLote  = '000' . $numeroLote;
        }
        if ($producto->id >= 10 && $producto->id < 100) {
            $numeroLote  = '00' . $numeroLote;
        }
        if ($producto->id >= 100 && $producto->id < 1000) {
            $numeroLote  = '0' . $numeroLote;
        }
        $producto->sku =  strtoupper($inicioTitulo) . '-' . strtoupper($inicioNombreProducto) . '-' . $numeroLote;
        $producto->save();
        return $producto;
    }

    public function crearProducto($request)
    {
        $producto = Producto::create([
            'nombre' => $request->name,
            'category_id' => $request->categoria_id,
            'precio' => $request->price,
            'descripcion' => $request->description,
            'alias' => $request->alias,
            'imagen' => $request,
        ]);
        return $this->generarSkuFormato4($producto);
    }
    public function actualizarProducto($producto, $request)
    {

        $producto->update([
            'nombre' => $request->name,
            'precio' => $request->price,
            'descripcion' => $request->description,
            'category_id' => $request->categoria_id,
            'alias' => $request->alias,
            'sku' => $request->sku
        ]);
    }
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
