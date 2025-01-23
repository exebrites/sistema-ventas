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
        $material = $producto->material;
        $color = $producto->color;
        $anio = $producto->anio_publicacion;
        $id = $producto->id;

        if (!isset($material)) {
            return throw new \Exception('El producto no tiene material');
        }
        if (!isset($color)) {
            return throw new \Exception('El producto no tiene color');
        }
        if (!isset($anio)) {
            return throw new \Exception('El producto no tiene año de publicacion');
        }

        $material = $this->subCadenaUpperCase($producto->material);
        $color = $this->subCadenaUpperCase($producto->color);

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
        $marca = $producto->marca;
        $tamanio = $producto->tamanio;
        $numeroLote = $this->generarNumeroLote($producto->id);


        if (!isset($marca)) {
            return throw new \Exception('El producto no tiene marca');
        }
        if (!isset($tamanio)) {
            return throw new \Exception('El producto no tiene tamanio');
        }

        $marca = $this->subCadenaUpperCase($producto->marca);
        $tamanio = $this->subCadenaUpperCase($producto->tamanio);
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

        $categoria  = $this->extraerCategoria($producto);
        $dim =  $producto->dimensiones;
        $autor = $producto->autor;
        $id = $producto->id;

        if (!isset($dim)) {
            return throw new \Exception('El producto no tiene dimensiones');
        }
        if (!isset($autor)) {
            return throw new \Exception('El producto no tiene autor');
        }
        $dim =  $this->formatoDimensiones($producto->dimensiones);
        $autor = $this->extraerAutor($producto->autor);
        $attributes = [
            'category' => $categoria,
            'author' => $autor,
            'dimensions' => $dim,
            'id' => $id
        ];

        dd($attributes);
        return $attributes;
        // $sku = $categoria . '-' . $dim . '-' . $autor . '-' . $id;
        // return $estructura . '->' . $sku;
    }
    public function generarSkuFormato4($producto)
    { //F4:CATEGORÍA-NOMBRE-NUMEROLOTE
        $categoria  = $this->extraerCategoria($producto);
        $inicioNombreProducto  = $this->subCadenaUpperCase($producto->nombre);
        $numeroLote = $this->generarNumeroLote($producto->id);
        $attributes = [
            'category' => $categoria,
            'nombre' => $inicioNombreProducto,
            'lote' => $numeroLote
        ];
        return $attributes;
    }

    public function crearProducto($request)
    {
        $producto = Producto::create([
            'nombre' => $request->name,
            'category_id' => $request->categoria_id,
            'precio' => $request->price,
            'descripcion' => $request->description,
            'alias' => '$request->alias',
            'imagen' => $request,

        ]);

        return $producto;
    }

    public function generarSku($producto, $tipo = 'A')
    {
dd([$producto,$tipo]);
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
                $attributes = $this->generarSkuFormato4($producto);
                break;
            default:
                # code...
                break;
        }
dd($attributes);
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
            'sku' => $request->sku,
            'material' => $request->material,
            'color' => $request->color,
            'anio_publicacion' => $request->anio_publicacion,
            'marca' => $request->marca,
            'tamanio' => $request->tamanio,
            'dimensiones' => $request->dimensiones,
            'autor' => $request->autor
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
