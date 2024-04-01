<?php

namespace App\Models;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Respuesta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use OwenIt\Auditing\Contracts\Auditable;


class Disenio extends Model implements Auditable
{


    use \OwenIt\Auditing\Auditable;
    protected $table = 'disenios';

    protected $fillable = ['detallePedido_id', 'url_imagen', 'url_disenio', 'disenio_estado', 'revision'];
    // id integer [pk]
    // detallePedido_id integer
    // url_imagen string
    // url_disenio string
    // diseno_estado boolean

    /*----------------------------ATRIBUTOS----------------------------------------*/


    /*----------------------------METODOS-----------------------------------------*/


    /*----------------------------RELACIONES----------------------------------------*/
    /*AGREGAR ATRIBUTOS*/

    /*AGREGAR METODOS*/

    /*AGREGAR RELACIONES*/
    // public function producto()
    // {
    //     return $this->belongsTo('App\Models\Producto');
    // }

    public function detallePedido()
    {
        return $this->belongsTo('App\Models\DetallePedido', 'detallePedido_id', '');
    }
    public function respuesta()
    {
        return $this->hasMany(Respuesta::class, 'disenio_id', '');
    }

    use HasFactory;
}
