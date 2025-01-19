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
    use HasFactory;

    protected $table = 'productos';
    protected $fillable = ['nombre', 'precio',  'descripcion', 'category_id', 'imagen', 'alias', 'visitas','stock','activo'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'category_id', '');
    }

    public function detallePedido()
    {
        return $this->hasMany(DetallePedido::class, 'producto_id', '');
    }

    public function detalleProducto()
    {
        return $this->hasMany(DetalleProducto::class, 'producto_id', 'id');
    }

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

}
