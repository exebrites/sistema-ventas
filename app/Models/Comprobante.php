<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    protected $table = 'comprobantes';
    protected $fillable= ['pedido_id','url_comprobantes'];

    public function pedido(){
        return $this->belongsTo('\App\Models\Pedido','pedido_id','id');
    }
    
    use HasFactory;
}
