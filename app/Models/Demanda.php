<?php

namespace App\Models;

use App\Http\Controllers\RegDemandaProveedor;
use App\Models\DetalleDemanda;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demanda extends Model
{
    protected $fillable = ['estado', 'fecha_cierre'];
    protected $table = "demandas";

    public static function combinar($lista, $materiales_compra)
    {
        // dd([$lista, $materiales_compra]);
        // Crear un nuevo array para almacenar la combinación de ambos
        $resultado = [];
        // Recorrer el array $orden
        foreach ($lista as $elemento_lista) {
            $materiales_id = $elemento_lista['id'];
            $cantidad_orden = $elemento_lista['cantidad'];

            // Buscar el mismo material en el array $compra
            $clave_compra = array_search($materiales_id, array_column($materiales_compra, 'id'));

            if ($clave_compra !== false) {

                // Si se encuentra, agregar las cantidades
                $cantidad_compra = $materiales_compra[$clave_compra]['cantidad'];
                // dd($cantidad_compra);
                $resultado[] = ['id' => $materiales_id, 'cantidad' => $cantidad_orden + $cantidad_compra];
            } else {
                // Si no se encuentra, agregar el elemento tal cual está en $orden
                $resultado[] = $elemento_lista;
            }
        }
      
        // Agregar los elementos de $compra que no estén en $orden

        foreach ($materiales_compra as $elemento_compra) {
            $materiales_id_compra = $elemento_compra['id'];

            // Verificar si el material ya está en $resultado
            $clave_resultado = array_search($materiales_id_compra, array_column($resultado, 'id'));

            if ($clave_resultado === false) {
                // Si no está, agregar el elemento de $compra tal cual está
                $resultado[] = $elemento_compra;
            }
        }

        // Imprimir el resultado
        return $resultado;
    }
    public function detalleDemandas()
    {
        return $this->hasMany(DetalleDemanda::class, 'demandas_id', 'id');
    }

    public function registroDemandaProveedor()
    {
        return $this->hasOne(registroPedidoDemanda::class, 'demanda_id', '');
    }
    public function demandaProveedor()
    {
        return $this->hasMany(DemandaProveedor::class, 'demanda_id', '');
    }
    public function oferta()
    {
        return $this->hasMany(Oferta::class, 'demanda_id', '');
    }
    public function demandaPedido()
    {
        return $this->hasOne(registroPedidoDemanda::class, 'demanda_id', '');
    }
    use HasFactory;
}
