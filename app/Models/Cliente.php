<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SistOliva;
use App\Models\Pedido;
use OwenIt\Auditing\Contracts\Auditable;

class Cliente extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = "clientes";
    protected $fillable = ['dni', 'nombre', 'apellido', 'telefono', 'correo'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'clientes_id', '');
    }
    public function scopeObtenerCliente($query, $user)
    {
        return $query->where('correo', $user->email)->first();
    }
}
