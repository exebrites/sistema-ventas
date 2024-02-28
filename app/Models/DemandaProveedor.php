<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandaProveedor extends Model
{
    protected  $table = "demanda_proveedores";
    protected $fillable = ['demanda_id', 'proveedor_id'];


    public function demanda()
    {
        return $this->belongsTo(Demanda::class, 'demanda_id', '');
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id', '');
    }
    use HasFactory;
}
