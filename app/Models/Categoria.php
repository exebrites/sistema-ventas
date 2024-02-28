<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;


class Categoria extends Model
{
    protected $table = 'categorias';
    protected $fillable = ['titulo', 'descripcion'];


    /*RELACIONES 1 A MUCHO*/
    public function producto()
    {
        return $this->hasMany(Producto::class);
    }

    /*RELACIONES 1 A 1*/

    use HasFactory;
}
