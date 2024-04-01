<?php

namespace App\Models;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use OwenIt\Auditing\Contracts\Auditable;



class Oferta extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = "ofertas";
    protected $fillable = ['demanda_id', 'proveedor_id', 'fecha_entrega', 'estado', 'finalizar_oferta'];


    public function detalleOferta()
    {
        return $this->hasMany(DetalleOferta::class, 'oferta_id', '');
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id', '');
    }
    public function demanda()
    {
        return $this->belongsTo(Demanda::class, 'demanda_id', '');
    }
    use HasFactory;
}
