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
use Illuminate\Support\Facades\Storage;

class Producto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;


    protected $table = 'productos';
    protected $fillable = ['nombre', 'precio',  'descripcion', 'category_id', 'imagen', 'alias', 'visitas','stock'];
    private string $nombre;
    private float $precio;
    public function disenio()
    {
        return $this->hasOne(Disenio::class, 'idProducto'); //tiene como FK a idproducto
    }
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'category_id', '');
    }

    public function sistOliva()
    {
        return $this->hasMany(SistOliva::class, 'idSistema');
    }
    public function detallePedido()
    {
        return $this->hasMany(DetallePedido::class, 'producto_id', '');
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


    public function proporcionCantidad($cantidad)
    {
        // retornar una lista de materiales con las cantidades proporcionales a la cantidad solictada
        // dump("proporciion");
        // dump($this->id . " " . $cantidad);
        $materiales = $this->listaMaterial();
        $proporcion = [];
        foreach ($materiales as $key => $material) {
            // dump($material['id']);
            $proporcion[$key] = [
                'id' => $material['id'],
                'nombre' => $material['nombre'],
                'cantidad' => $material['cantidad'] * $cantidad
            ];
            // dump($material['cantidad'] * $cantidad);
        }

        // dd($proporcion);
        return  $proporcion;
    }


    //Query Scopes
    public function scopeBuscar($query, $buscar)
    {
        return $query->where('name', 'like', '%' . $buscar . '%')->take(5);
    }

    //mutadores y accesors
    public function setNombreAttribute($name)
    {
        return $this->attributes['nombre'] = strtoupper($name);
    }
    public function setImagenAttribute($request)
    {
        $imagen =  $request->file('file')->store('public');
        $url = Storage::url($imagen);
        return $this->attributes['imagen'] = $url;
    }

    use HasFactory;
}
