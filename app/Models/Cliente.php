<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SistOliva;

use OwenIt\Auditing\Contracts\Auditable;



class Cliente extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = "clientes";

    // Indica que la clave primaria es el campo 'dni'
    // protected $primaryKey = 'dni';

    // Indica que la clave primaria no es un número entero autoincremental
    // public $incrementing = false;

    // Indica que el tipo de dato de la clave primaria es una cadena
    // protected $keyType = 'string';

    // Resto de las propiedades del modelo
    protected $fillable = ['dni', 'nombre', 'apellido', 'telefono', 'correo'];


    /*----------------------------ATRIBUTOS----------------------------------------*/


    /*----------------------------METODOS-----------------------------------------*/


    /*----------------------------RELACIONES----------------------------------------*/

    /*AGREGAR ATRIBUTOS*/

    /*AGREGAR METODOS*/

    /*AGREGAR RELACIONES*/

    //SIN PROBAR 

    public function pedidos()
    {
        //llamado al modelo, como es fk en tabla pedidos, como es pk
        return $this->hasMany('\App\Models\Pedido', 'clientes_id', '');
    }

    use HasFactory;

    //scopes
    public function scopeObtenerCliente($query, $user)
    {
        return $query->where('correo', $user->email)->first();
    }
}
