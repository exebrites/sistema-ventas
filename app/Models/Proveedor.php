<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $fillable = ['nombre_empresa', 'nombre_contacto', 'cuit', 'telefono', 'correo'];
    // id integer pk
    // nombre_empresa string
    // nombre_contacto string
    // cuit string
    // telefono string
    // correo string

    public function materialProveedor()
    {
        //nota: los has van en los modelos que proveen FK
        return $this->hasMany('App\Models\MaterialProveedor', 'proveedor_id', 'id');
    }

    public function demandaProveedor()
    {
        return $this->hasMany(DemandaProveedor::class, 'proveedor_id', '');
    }

    public function oferta()
    {
        return $this->hasMany(Oferta::class, 'proveedor_id', '');
    }
    use HasFactory;
}
