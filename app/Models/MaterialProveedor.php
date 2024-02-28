<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialProveedor extends Model
{
    protected $table = "material_proveedor";
    protected $fillable = ['proveedor_id', 'material_id', 'precio_actual', 'precio_actualizado'];

    // id integer
    // proveedor_id integer
    // material_id integer
    // precio_actual float
    // precio_actualizado float
    public function proveedor()
    {
        //nota: los belongto van en los modelos que tienen FK
        return $this->belongsTo('App\Models\Proveedor', 'proveedor_id');
    }
    public function material()
    {
        //nota: los belongto van en los modelos que tienen FK
        return $this->belongsTo('App\Models\Material', 'material_id');
    }



    use HasFactory;
}
