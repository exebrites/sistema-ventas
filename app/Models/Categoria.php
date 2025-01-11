<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;


class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';
    protected $fillable = ['titulo', 'descripcion'];

    public function producto()
    {
        return $this->hasMany(Producto::class);
    }
}
