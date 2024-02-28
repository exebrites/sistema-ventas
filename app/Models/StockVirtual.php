<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockVirtual extends Model
{
    protected $table = "stock_virtual";
    protected $fillable = ['material_id','nombre', 'cantidad'];
    use HasFactory;
}
