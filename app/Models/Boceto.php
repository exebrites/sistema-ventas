<?php

namespace App\Models;

use App\Models\DetallePedido;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Boceto extends Model
{
    protected $fillable = ['negocio', 'objetivo', 'publico', 'contenido', 'url_logo', 'url_img', 'detallePedido_id'];
    protected $table = 'bocetos';


    public function detallePedido()
    {
        return $this->belongsTo(DetallePedido::class, 'detallePedido_id', '');
    }

    use HasFactory;
}
