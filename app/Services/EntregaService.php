<?php

namespace App\Services;

use App\Models\Entrega;


class EntregaService
{
    public function create($datos, $id)
    {

        return  
        $entrega = Entrega::create([
            'pedido_id' => $id,
            'direccion' => $datos['direccion'],
            'telefono' => $datos['telefono'],
            'recepcion' => $datos['personaRecepcion'],
            'nota' => $datos['nota'],
            'local' => $datos['retiroLocal'],
        ]);
        return $entrega;
    }
}
