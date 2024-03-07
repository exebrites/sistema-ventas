<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePresupuesto extends Model
{
    protected $table = "detalle_presupuestos";
    protected $fillable = ['producto_id', 'presupuesto_id', 'cantidad', 'precio', 'disenio', 'servicio'];
    use HasFactory;
}
