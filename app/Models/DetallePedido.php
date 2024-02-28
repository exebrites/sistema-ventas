<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table = "detalle_pedidos";
    protected $fillable = ['pedido_id', 'producto_id', 'cantidad', 'subtotal', 'produccion'];
    // id integer pk
    // pedido_id integer
    // producto_id integer
    // cantidad integer
    // subtotal float
   
    public function disenio()
    {
        return $this->hasOne('\App\Models\Disenio', 'detallePedido_id', '');
    }
    public function boceto()
    {
        return $this->hasOne('\App\Models\Boceto', 'detallePedido_id', '');
    }

    public function pedidos()
    {
        return $this->belongsTo('\App\Models\Pedido', 'pedido_id', 'id');
    }

    public function producto()
    {
        return $this->belongsTo('\App\Models\Producto', 'producto_id', 'id');
    }
    use HasFactory;
}
