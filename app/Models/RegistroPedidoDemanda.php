<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroPedidoDemanda extends Model
{
    protected $table = "registro_pedido_demandas";
    protected $fillable = ['pedido_id', 'demanda_id'];

    public function demanda()
    {
        return $this->belongsTo(Demanda::class, 'demanda_id', '');
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id', '');
    }
    use HasFactory;
}
