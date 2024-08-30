<?php

namespace App\Http\Controllers;

use App\Models\Boceto;
use App\Models\Pedido;
use App\Models\Disenio;
use App\Models\Comprobante;
use App\Models\Demanda;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InicioController extends Controller
{
    private static function pedidos_revision($estado)
    {
        //objetivo :
        // Calcular el numero de pedidos en estado de disenio que tiene para hacer revision de disenio
        $nroPedidosRevision = 0;
        $pedidosDisenio = Pedido::where('estado_id', $estado)->get();
        foreach ($pedidosDisenio as $pedido) {
            foreach ($pedido->detallePedido as $detalle) {
                if ($detalle->disenio->revision === 1) {
                    $nroPedidosRevision++;
                }
            }
        }
        return $nroPedidosRevision;
    }
    private static function pedidos_disenios_aprobados($estado)
    {
        //objetivo :
        // Calcular el numero de pedidos en estado de disenio que tiene diseños aprobados ->listos para preproduccion
        $nroPedidosDiseniosAprobados = 0;
        $pedidosDisenio = Pedido::where('estado_id', $estado)->get();
        foreach ($pedidosDisenio as $pedido) {
            foreach ($pedido->detallePedido as $detalle) {
                if ($detalle->produccion === 1) {
                    $nroPedidosDiseniosAprobados++;
                }
            }
        }
        return $nroPedidosDiseniosAprobados;
    }
    public function inicio()
    {
        $estadoPendiente = 2;
        $estadoDisenio = 5;
        $estadoInicio = 3;
        $estadoImprenta = 1;
        $user = Auth::user();
        $NroComprobantes = Pedido::where('estado_id', $estadoPendiente)->count();
        $NroPedidos = Pedido::where('estado_id', 3)->count();
        $nroPedidoImprenta = Pedido::where('estado_id', $estadoImprenta)->count();

        $NroDisenios = 1;
        $NroRevision = $this->pedidos_revision($estadoDisenio);

        $nroboceto = 0;
        $bocetos = Boceto::all();
        foreach ($bocetos as $key => $boceto) {
            if (!$boceto->detallePedido->disenio->disenio_estado) {
                $nroboceto++;
            }
        }
        $nroofertas = 0;
        $demandas = Demanda::all();
        foreach ($demandas as $key => $demanda) {
            foreach ($demanda->oferta as $key => $oferta) {
                if ($oferta->estado == "pendiente") {
                    $nroofertas++;
                }
            }
        }
        // dd($nroofertas); 
        $nroPedidosDiseniosAprobados =  $this->pedidos_disenios_aprobados($estadoDisenio);
        return view('welcome', compact('user', 'NroComprobantes', 'NroPedidos', 'NroDisenios', 'NroRevision', 'nroboceto', 'nroofertas', 'nroPedidoImprenta', 'nroPedidosDiseniosAprobados'));
    }

    public function ver_pedido($estado)
    {

        $pedidos = Pedido::where('estado_id', $estado)->get();

        return view('pedido.index', compact('pedidos'));
    }
    public function ver_oferta($estado = "pendiente")
    {
        return $estado;
    }
    public function ver_pedido_boceto()
    {
        // objetivo
        // mostrar solo los pedidos que tengan un boceto sin un disenio 
        // $pedidosSinFiltro = Pedido::where('estado_id', '<>', 11);
        $pedidosSinFiltro = Pedido::whereNotIn('estado_id', [11])->get();


        // dd($pedidosSinFiltro);
        $pedidos = [];
        foreach ($pedidosSinFiltro as $key => $pedido) {

            foreach ($pedido->detallePedido as $key => $detalle) {

                if ($detalle->boceto) {
                    $pedidos[] = $pedido;
                }
            }
        }
        return  view('pedido.index', compact('pedidos'));
    }
    public function ver_pedido_disenio_revision()
    {
        // objetivo 
        //     mostrar solo los pedidos que esten con disenio para revision
        // Cuando Disenio->revision sea igual a 0 significa que se envió al cliente       
        // * Cuando Disenio->revision sea igual a 1 significa que el cliente vió el Diseño, 
        // lo califico y lo mando a revision. Disconformidad 

        $estadoDisenio = 5;
        $pedidos  = [];
        $NroPedidosDisenio = Pedido::where('estado_id', $estadoDisenio)->get();
        // dd($NroPedidosDisenio);
        foreach ($NroPedidosDisenio as $key => $pedido) {
            foreach ($pedido->detallePedido as $key => $detalle) {

                if ($detalle->disenio->revision) {
                    $pedidos[] = $pedido;
                }
            }
        }
        return view('pedido.index', compact('pedidos'));
    }
    public function ver_pedido_disenio_aprobado()
    {
        // objetivo 
        //     mostrar solo los pedidos que esten con disenio para revision
        // Cuando Disenio->revision sea igual a 0 significa que se envió al cliente       
        // * Cuando Disenio->revision sea igual a 1 significa que el cliente vió el Diseño, 
        // lo califico y lo mando a revision. Disconformidad 

        $estadoDisenio = 5;
        $pedidos  = [];
        $pedidosDisenio = Pedido::where('estado_id', $estadoDisenio)->get();
        // dd($NroPedidosDisenio);
        foreach ($pedidosDisenio as $pedido) {
            foreach ($pedido->detallePedido as  $detalle) {

                if ($detalle->produccion === 1) {
                    $pedidos[] = $pedido;
                }
            }
        }
        return view('pedido.index', compact('pedidos'));
    }
}
