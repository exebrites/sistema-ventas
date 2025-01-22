<?php

namespace App\Services;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use App\Services\Sku\SkuGenerator;
use App\Services\Sku\Strategies\CategoryDimensionsAuthorStrategy;
use App\Services\Sku\Strategies\CategoryMaterialColorStrategy;
use App\Services\Factories\SkuStrategyFactory;

class ProductoService
{

    private function subCadenaUpperCase($cadena)
    {
        $inicioTitulo = substr($cadena, 0, 3);
        return strtoupper($inicioTitulo);
    }
    private function generarNumeroLote($id)
    {
        $numeroLote = (string)$id;
        if (($id) < 10) {
            $numeroLote  = '000' . $numeroLote;
        }
        if ($id >= 10 && $id < 100) {
            $numeroLote  = '00' . $numeroLote;
        }
        if ($id >= 100 && $id < 1000) {
            $numeroLote  = '0' . $numeroLote;
        }
        return $numeroLote;
    }
    private function extraerCategoria($producto)
    {
        $tituloCategoria  = $producto->categoria->titulo;

        return $this->subCadenaUpperCase($tituloCategoria);
    }
    public function generarSkuFormato1($producto)
    {
        // CATEGORÍA-MATERIAL-COLOR-AÑO-ID
        // WSHD-PL-SB-2010-0001
        $categoria  = $this->extraerCategoria($producto);
        $material = $this->subCadenaUpperCase($producto->material);
        $color = $this->subCadenaUpperCase($producto->color);
        $anio = $producto->anio_publicacion;
        $id = $producto->id;
        $attributes = [
            'category' => $categoria,
            'author' => $material,
            'dimensions' => $color,
            'year' => $anio,
            'id' => $id
        ];
        return $attributes;
    }
    public function generarSkuFormato2($producto)
    {
        // Estructura: NOMBRE-MARCA-TAMAÑO-SKU


        $nombre =  $this->subCadenaUpperCase($producto->nombre);
        $marca = $this->subCadenaUpperCase($producto->marca);
        $tamanio = $this->subCadenaUpperCase($producto->tamanio);
        $numeroLote = $this->generarNumeroLote($producto->id);
        $attributes = [
            'nombre' => $nombre,
            'marca' => $marca,
            'tamanio' => $tamanio,
            'lote' => $numeroLote

        ];
        return $attributes;
    }
    private function formatoDimensiones($dimensiones)
    {

        $dimensiones = str_replace(' ', '', $dimensiones);
        // $dimensiones = explode('x', $dimensiones);
        // $alto  = $dimensiones[0];

        // $ancho = $dimensiones[1];
        // $profundidad = $dimensiones[2];
        // return $alto . 'x' . $ancho . 'x' . $profundidad;
        return $dimensiones;
    }
    private function extraerAutor($autor)
    {
        $nombreApellidoAutor = explode(' ', $autor);
        $nombre = $this->subCadenaUpperCase($nombreApellidoAutor[0]);
        $apellido = $this->subCadenaUpperCase($nombreApellidoAutor[1]);
        $autor = $nombre . ':' . $apellido;
        return $autor;
    }
    public function generarSkuFormato3($producto)
    {
        //         Estructura: CAT-DIM-AUTOR-ID
        // Ejemplo:
        // FHFM-3213x137558x75090-1-295
        $estructura = 'CAT-DIM-AUTOR-ID';
        $categoria  = $this->extraerCategoria($producto);
        $dim =  $this->formatoDimensiones($producto->dimensiones);
        $autor = $this->extraerAutor($producto->autor);
        $id = $producto->id;

        $attributes = [
            'category' => $categoria,
            'author' => $autor,
            'dimensions' => $dim,
            'id' => $id
        ];
        return $attributes;
        // $sku = $categoria . '-' . $dim . '-' . $autor . '-' . $id;
        // return $estructura . '->' . $sku;
    }
    public function generarSkuFormato4($producto)
    { //generacion de sku apartir de la categoria,nombre y numero secuencia lote
        $tituloCategoria  = $producto->categoria->titulo;
        $inicioTitulo = substr($tituloCategoria, 0, 3);
        $inicioNombreProducto  = substr($producto->nombre, 0, 3);
        $numeroLote = $this->generarNumeroLote($producto->id);
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

        // return $this->generarSkuFormato1($producto);
    }

    public function generarSku($producto, $tipo = 'A')
    {

        switch ($tipo) {
            case 'A':
                # code...
                $attributes = $this->generarSkuFormato1($producto);
                break;
            case 'B':
                # code...
                $attributes = $this->generarSkuFormato2($producto);
                break;
            case 'C':
                # code...
                $attributes = $this->generarSkuFormato3($producto);
                break;
            case 'D':
                # code...
                // $attributes = $this->generarSkuFormato4($producto);
                break;
            default:
                # code...
                break;
        }

        $strategy = SkuStrategyFactory::create($attributes);
        $generator = new SkuGenerator($strategy);
        $producto->sku = $generator->generate($attributes);
        $producto->save();
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
