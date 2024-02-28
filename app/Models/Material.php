<?php

namespace App\Models;

use App\Models\Pedido;
use App\Models\DetalleOferta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    protected $table = "materiales";
    protected $fillable = ['nombre', 'descripcion', 'cod_interno', 'stock', 'unidad_medida', 'fecha_adquisicion', 'fecha_vencimiento', 'notas', 'precio_compra'];


    public function materialProveedor()
    {
        //nota: los has van en los modelos que proveen FK
        return $this->hasMany('App\Models\MaterialProveedor', 'material_id', 'id');
    }

    public function detalleDemandas()
    {
        return $this->hasMany(DetalleDemanda::class, 'materiales_id', 'id');
    }
    public function detalleOferta()
    {
        return $this->hasMany(DetalleOferta::class, 'material_id', '');
    }


    public static function stockVirtual($demanda_id)
    {
        $pedidos = Pedido::where('estado_id', 5)->get();
        $listaMateriales = Pedido::listaMateriales($pedidos);
        $demanda = Demanda::find($demanda_id);
        $oferta = Oferta::where('demanda_id', $demanda_id)->where('estado', 'aceptada')->first();
        $detalles = $oferta->detalleOferta;
        $stockAceptado = [];
        foreach ($detalles as $key => $detalle) {
            $stockAceptado[$detalle->material_id] = ['id' => $detalle->material_id, 'cantidad' => $detalle->cantidad];
        }

        dd($stockAceptado);



        // $materialesStock = [];
        // foreach ($listaMateriales as $key => $mat) {

        //     $material = Material::find($mat['id']);
        //     $diferencia = $material->stock  - $mat['cantidad'];
        //     $materialesStock[$key] = [
        //         'id' => $mat['id'],
        //         'nombre' => $material->nombre,
        //         'stockActual' => $material->stock,
        //         'stockSolicitado' => $mat['cantidad'],
        //         'diferenciaStock' => $diferencia,
        //     ];
        // }
        // return $materialesStock;
    }
    use HasFactory;
}
