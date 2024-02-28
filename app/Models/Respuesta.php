<?php

namespace App\Models;

use App\Models\Pregunta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Respuesta extends Model
{
    protected $fillable = ['pregunta_id', 'disenio_id', 'contenido_respuesta'];
    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'pregunta_id', '');
    }
    use HasFactory;
}
