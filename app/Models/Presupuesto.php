<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $table = "presupuestos";
    protected $fillable = ['cliente_id', 'fecha_entrega'];


    
    use HasFactory;
}
