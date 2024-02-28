<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Disenio;
use App\Models\Comprobante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InicioController extends Controller
{
    public function inicio()
    {

        $user = Auth::user();
        //numero de comprobantes pendientes
        // $NroComprobantes = Comprobante::count();
        $NroComprobantes = Pedido::where('estado_id', 1)->count();
        $NroPedidos = Pedido::where('estado_id', 3)->count();
        $NroDisenios = Disenio::count();
        // $NroOfertas=
        return view('welcome', compact('user', 'NroComprobantes', 'NroPedidos', 'NroDisenios'));
    }
}
