<?php

namespace App\Models;

use App\Models\Material;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleProducto extends Model
{
    protected $fillable = ['producto_id', 'proveedor_id', 'cantidad'];
    protected $table = "detalle_productos";
    
   public function proveedores ()
    {
       return $this->belongsTo(Proveedor::class, 'proveedor_id', '');
   }
    public function productos()
    {
        return $this->belongsTo(Producto::class, 'producto_id', '');
    }
    use HasFactory;
}
