<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Pedido;

class SistOliva extends Model
{






    /*----------------------------ATRIBUTOS----------------------------------------*/
    /*AGREGAR ATRIBUTOS*/

    /*----------------------------METODOS-----------------------------------------*/

    /*AGREGAR METODOS*/
    public function seleccionarProducto($idProducto)
    {
    }

    public function ingresarDiseño()
    {
        /**PARAMETROS
         unProducto,diseño,texto,boolean
         */
    }
    /*----------------------------RELACIONES----------------------------------------*/

    /*AGREGAR RELACIONES*/
    


    //SIN PROBAR 

    public function clientes(){
        return $this->hasMany(Cliente::class,'idSistema');
    }
    
    public function producto (){
        return $this->belongsTo(Producto::class);
    }
    
    public function pedido (){
        return $this->belongsTo(Pedido::class);
    }
    use HasFactory;
}
