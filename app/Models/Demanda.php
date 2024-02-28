<?php

namespace App\Models;

use App\Http\Controllers\RegDemandaProveedor;
use App\Models\DetalleDemanda;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demanda extends Model
{
    protected $fillable = ['estado', 'fecha_cierre'];
    protected $table = "demandas";

    public function detalleDemandas()
    {
        return $this->hasMany(DetalleDemanda::class, 'demandas_id', 'id');
    }

    public function registroDemandaProveedor()
    {
        return $this->hasOne(registroPedidoDemanda::class, 'demanda_id', '');
    }
    public function demandaProveedor()
    {
        return $this->hasMany(DemandaProveedor::class, 'demanda_id', '');
    }
    public function oferta()
    {
        return $this->hasMany(Oferta::class, 'demanda_id', '');
    }
    public function demandaPedido()
    {
        return $this->hasOne(registroPedidoDemanda::class, 'demanda_id', '');
    }
    use HasFactory;
}
