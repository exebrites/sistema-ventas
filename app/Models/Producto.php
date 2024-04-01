<?php

namespace App\Models;

use App\Models\Pedido;
use App\Models\Disenio;
use App\Models\Categoria;
use App\Models\SistOliva;
use App\Models\DetalleProducto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Producto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;


    protected $table = 'productos';
    protected $fillable = ['name', 'price', 'slug', 'description', 'category_id', 'image_path', 'alias', 'visitas'];
    /*----------------------------ATRIBUTOS----------------------------------------*/
    /*AGREGAR ATRIBUTOS*/
    private string $nombre;
    private float $precio;
    /*----------------------------METODOS-----------------------------------------*/

    /*AGREGAR METODOS*/

    /*----------------------------RELACIONES----------------------------------------*/
    /*AGREGAR RELACIONES*/
    public function disenio()
    {
        return $this->hasOne(Disenio::class, 'idProducto'); //tiene como FK a idproducto
    }

    //SIN PROBAR 

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function sistOliva()
    {
        return $this->hasMany(SistOliva::class, 'idSistema');
    }

    // public function pedidos()
    // {
    //     return $this->hasMany('\App\Models\Pedido','productos_id','');

    // }

    public function detallePedido()
    {
        return $this->hasMany('\App\Models\DetallePedido', 'producto_id', '');
    }

    public function detalleProducto()
    {
        return $this->hasMany(DetalleProducto::class, 'producto_id', 'id');
    }

    // nombre de metodo en calmeCase
    public function listaMaterial()
    {

        // que materiales y cual es la cantidad para producir este producto 


        // conocer que materiales y cual es la cantidad asociada 
        $detalles = $this->detalleProducto;
        $materiales = [];
        foreach ($detalles as $key => $detalle) {
            # code...
            // print($detalle->cantidad);
            // nombre y cantidad clave valor
            $materiales[$key] = [
                'id' => $detalle->materiales->id,
                'nombre' => $detalle->materiales->nombre,
                'cantidad' => $detalle->cantidad
            ];
        }

        return $materiales;
    }


    public function proporcionCantidad($cantidad = 1)
    {
        // retornar una lista de materiales con las cantidades proporcionales a la cantidad solictada

        $materiales = $this->listaMaterial();
        $proporcion = [];
        foreach ($materiales as $key => $material) {
            $proporcion[$key] = [
                'id' => $material['id'],
                'nombre' => $material['nombre'],
                'cantidad' => $material['cantidad'] * $cantidad
            ];
        }
        return  $proporcion;
    }
    use HasFactory;
}
