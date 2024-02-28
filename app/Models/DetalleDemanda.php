<?php

namespace App\Models;

use App\Models\Demanda;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleDemanda extends Model
{
    protected $fillable = ['demandas_id', 'materiales_id', 'cantidad'];
    protected $table = "detalle_demandas";

    public function demanda()
    {
        return $this->belongsTo(Demanda::class, 'demandas_id', 'id');
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'materiales_id', 'id');
    }
    use HasFactory;
}
