<?php

namespace App\Models;

use Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CostoDisenio extends Model
{
    protected  $table = "costo_disenios";
    protected $fillable = ['hora_disenio', 'horas_disenio_completo', 'horas_disenio_asistido', 'porcentaje_costo'];

    public static function costo_total_disenio()
    {
        $cartCollection = \Cart::getContent();
        // dd($cartCollection);
        $costo_total = 0;



        foreach ($cartCollection as $key => $producto) {
            $costo_total =  $costo_total +   $producto->attributes['costo_disenio'];
        }
        return $costo_total;
    }
    public static function costo_disenio($precio, $cantidad, $estado)
    {
        $subtotal = $precio * $cantidad;
        $costo_disenio = CostoDisenio::find(1);
        $costo = 0;


        /*
        REGLA DE NEGOCIO 

            mayor cantidad de productos menor el porcentaje que se cobra al pedido

            menor a 50 u. se cobra el 50 % al costo total
            entre 50u y 100 u. se cobra un 40% al costo total
            entre 100u. y 200u. se cobra un 30% al costo total
            mayor a 200 u. se cobra un 25% al costo total del pedido 

        */

        $porcentajeCobro = $costo_disenio->porcentaje_costo;    # code...
        // if ($cantidad >= 50 && $cantidad < 100) {
        //     $porcentajeCobro = $costo_disenio->porcentaje_costo - 0.1;    # code...
        // } elseif ($cantidad >= 100 && $cantidad < 200) {
        //     $porcentajeCobro = $costo_disenio->porcentaje_costo - 0.2;    # code...
        // } elseif ($cantidad >= 200) {
        //     $porcentajeCobro = $costo_disenio->porcentaje_costo / 2;    # code...
        // }
        // dd($porcentajeCobro);
        if ($estado) {
            $costo_hs = $costo_disenio->horas_disenio_asistido * $costo_disenio->hora_disenio;
            $costo_porcentaje =  $porcentajeCobro * $subtotal;
        } else {
            $costo_hs = $costo_disenio->horas_disenio_completo * $costo_disenio->hora_disenio;
            $costo_porcentaje =  $porcentajeCobro * $subtotal;
        }

        // dump($costo_porcentaje);
        // dump($costo_hs);
        if ($costo_porcentaje >= $costo_hs) {
            $costo = $costo_porcentaje;
        } else {
            $costo = $costo_hs;
        }
        // dump($costo);
        // dd("");

        return $costo;
    }
    use HasFactory;
}
