<?php

namespace App\Models;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estado extends Model
{
    protected $table = "estados";
    protected $fillable = ['nombre', 'descripcion'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'estado_id', '');
    }

    use HasFactory;
}
