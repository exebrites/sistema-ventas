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
        if ($estado) {
            $costo_hs = $costo_disenio->horas_disenio_asistido * $costo_disenio->hora_disenio;
            $costo_porcentaje =  $costo_disenio->porcentaje_costo * $subtotal;
        } else {
            $costo_hs = $costo_disenio->horas_disenio_completo * $costo_disenio->hora_disenio;
            $costo_porcentaje =  $costo_disenio->porcentaje_costo * $subtotal;
        }

        if ($costo_porcentaje >= $costo_hs) {
            $costo = $costo_porcentaje;
        } else {
            $costo = $costo_hs;
        }

        return $costo;
    }
    use HasFactory;
}
