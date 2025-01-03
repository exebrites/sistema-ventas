<?php

namespace App\Models;

use Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class CostoDisenio extends Model
{
    protected  $table = "costo_disenios";
    protected $fillable = ['hora_disenio', 'horas_disenio_completo', 'horas_disenio_asistido', 'porcentaje_costo'];

    //Calcular el costo total de diseños en el carrito de compras
    public static function costo_total_disenio($cartCollection) //1. Usar calmeCase 
    {
        $costo_total = 0;
        foreach ($cartCollection as $producto) {
            $costo_total =  $costo_total +   $producto->attributes['costo_disenio'];
        }
        return $costo_total;
    }
    public  function costo_disenio($precio, $cantidad, $estado, $costo_disenio) //1. Usar calmeCase
    {
        /*
        REGLA DE NEGOCIO 

            mayor cantidad de productos menor el porcentaje que se cobra al pedido

            menor a 50 u. se cobra el 50 % al costo total
            entre 50u y 100 u. se cobra un 40% al costo total
            entre 100u. y 200u. se cobra un 30% al costo total
            mayor a 200 u. se cobra un 25% al costo total del pedido 

        */
        $subtotal = $precio * $cantidad;
        // $costo_disenio = CostoDisenio::find(1); //2. Evitar acoplamiento
        $costo = 0;
        $porcentajeCobro = $costo_disenio->porcentaje_costo;

        //Calcular el costo de diseño si tiene diseño o no
        if ($estado) { //3. Desacoplar if
            $costo_hs = $costo_disenio->horas_disenio_asistido * $costo_disenio->hora_disenio;
            $costo_porcentaje =  $porcentajeCobro * $subtotal;
        } else {
            $costo_hs = $costo_disenio->horas_disenio_completo * $costo_disenio->hora_disenio;
            $costo_porcentaje =  $porcentajeCobro * $subtotal;
        }


        //Determinar el costo a cobrar
        if ($this->determinarCostoCobrar($costo_porcentaje, $costo_hs)) { //4. Desacoplar if
            $costo = $costo_porcentaje;
        } else {
            $costo = $costo_hs;
        }

        return $costo;
    }
    private  function determinarCostoCobrar($costo_porcentaje, $costo_hs)
    {
        return $costo_porcentaje >= $costo_hs;
    }
    use HasFactory;
}
