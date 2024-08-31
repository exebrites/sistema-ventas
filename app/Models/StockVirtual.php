<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockVirtual extends Model
{
    protected $table = "stock_virtual";
    protected $fillable = ['material_id','nombre', 'cantidad'];

    public static function actualizar_stock_virtual()
    {
        //objetivo
        // actualizar el stock virtual en base a los cambios del stock real
        $stock_real  = Material::all();
        foreach ($stock_real as  $material) {
            # code...
            $material_sv = StockVirtual::where('material_id', $material->id)->first();
            if ($material_sv !== null) {
                $material_sv->update([
                    'material_id' => $material->id,
                    'nombre' => $material->nombre,
                    'cantidad' => $material->stock,
                ]);
            } else {
                StockVirtual::create([
                    'material_id' => $material->id,
                    'nombre' => $material->nombre,
                    'cantidad' => $material->stock,
                ]);
            }
        }
        $virtual_stock = StockVirtual::all();
        return $virtual_stock;
    }
    use HasFactory;
}
