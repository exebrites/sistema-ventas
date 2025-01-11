<?php

namespace App\Models;

use App\Models\Estado;
use App\Models\Cliente;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Entrega;

class Pedido extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;


    protected $table = "pedidos";
    protected $fillable = ['clientes_id',  'fecha_inicio', 'fecha_entrega', 'estado_id',  'costo_total'];
    public function scopeActivo($query)
    {
        $pedidos =  $query->where('estado_id', '!=', 11);
        return $pedidos->orderBy('estado_id');
    }
    public function scopePedidosCliente($query, $cliente)
    {
        return $query->where('clientes_id', $cliente->id)->orderBy('id', 'desc');
    }
    protected function getFechaEntregaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }
    protected function getFechaInicioAttribute($fecha_inicio)
    {
        if ($fecha_inicio != null) {
            return Carbon::parse($fecha_inicio)->format('d-m-Y');
        }
    }
    public function getTotal()
    {
        return $this->detallesPedido->sum('subtotal');
    }
    //COMIENZO DE RELACIONES
    public function entrega()
    {
        return $this->hasMany(Entrega::class, 'pedido_id', '');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id', '');
    }
    public function detallesPedido()
    {
        return $this->hasMany(DetallePedido::class, 'pedido_id', '');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clientes_id', 'id');
    }
    //FIN DE RELACIONES
}
