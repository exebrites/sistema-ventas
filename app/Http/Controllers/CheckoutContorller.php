<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutContorller extends Controller
{

    public function index()
    {

        $user = Auth::user()->id;
        $cliente = Cliente::find($user);

        $id = Pedido::max('id');

        $estado =  Pedido::where('id', $id)->value('estado');
        return view('checkout', ['estado' => $estado, 'id' => $id]);
    }

    public function show($id)
    {

        $pedido = Pedido::find($id);
        $estado = $pedido->estado;
        if ($pedido->fecha_inicio != null) {
            $fecha =  Carbon::parse($pedido->fecha_inicio);
            $pedido->fecha_inicio = $fecha->format('d-m-Y');
        }

        $fecha =  Carbon::parse($pedido->fecha_entrega);
        $pedido->fecha_entrega = $fecha->format('d-m-Y');

        return view('checkout', ['estado' => $estado, 'pedido' => $pedido]);
    }







    /**
    Codigo comentado Revisar
  

    public function index()
    {
        // Obtiene el ID del usuario autenticado
        $user = Auth::user()->id;

        // Busca un registro de cliente con el mismo ID que el usuario autenticado
        $cliente = Cliente::find($user);

        // Obtiene el ID máximo de la tabla 'pedidos'
        $id = Pedido::max('id');

        // Obtiene el estado de un pedido específico basado en el ID máximo
        $estado = Pedido::where('id', $id)->value('estado');

        // Retorna la vista 'checkout' con el estado y el ID
        return view('checkout', ['estado' => $estado, 'id' => $id]);
    }

    public function show($id)
    {
        // Busca un pedido específico por su ID
        $p = Pedido::find($id);

        // Inicializa la variable 'estado' con el valor 'pendiente-pago'
        $estado = 'pendiente-pago';

        // Si se encuentra un pedido, se actualiza 'estado' con el valor real del pedido
        if ($p) {
            $estado = $p->estado;
        }

        // Retorna la vista 'checkout' con el estado y el ID
        return view('checkout', ['estado' => $estado, 'id' => $id]);
    }
     */
}
