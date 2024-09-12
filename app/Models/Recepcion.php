<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    protected $table ='recepcion';
    protected $fillable =['material_id','cantidad'];
    use HasFactory;
}
