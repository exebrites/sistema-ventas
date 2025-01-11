<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pedido;
use App\Models\Producto;

class DetallePedido extends Model
{
    use HasFactory;
    protected $table = "detalle_pedidos";
    protected $fillable = ['pedido_id', 'producto_id', 'cantidad', 'subtotal', 'produccion'];
    // public function disenio()
    // {
    //     return $this->hasOne('\App\Models\Disenio', 'detallePedido_id', '');
    // }
    // public function boceto()
    // {
    //     return $this->hasOne('\App\Models\Boceto', 'detallePedido_id', '');
    // }

    public function pedidos()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id', 'id');
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id');
    }
}
