<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroMaterial extends Model
{
    protected $table = 'registro_materiales';
    protected $fillable = ['material_id', 'cantidad'];
    use HasFactory;
}
