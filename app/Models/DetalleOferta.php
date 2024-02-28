<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOferta extends Model
{
    protected $table = "detalle_ofertas";
    protected $fillable = ['oferta_id', 'material_id', 'nombre', 'cantidad', 'precio'];


    public function oferta()
    {
        return $this->belongsTo(Oferta::class, 'oferta_id', '');
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', '');
    }
    use HasFactory;
}
