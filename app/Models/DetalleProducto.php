<?php

namespace App\Models;

use App\Models\Material;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleProducto extends Model
{
    protected $fillable = ['producto_id', 'material_id', 'cantidad'];
    protected $table = "detalle_productos";
    
    public function materiales()
    {
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }
    public function productos()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id');
    }
    use HasFactory;
}
