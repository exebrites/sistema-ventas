<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Boceto;
use App\Models\Estado;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Disenio;
use App\Events\OrdenCompra;
use Darryldecode\Cart\Cart;
use App\Mail\EstadoMailable;
use Illuminate\Http\Request;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedido.index', ['pedidos' => $pedidos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pedido.create');
    }

    public function show($id)
    {
        $pedido = Pedido::find($id);
        return view('pedido.show', compact('pedido'));
    }
    public function edit($id)
    {
        // return view('pedido.edit');
        $pedido = Pedido::find($id);
        return view('pedido.edit', ['pedido' => $pedido]);
    }


    //FIN DE FUNCIONES DE GESTIONAR PEDIDO

    public function procesarPedido(Request $request)
    {
        $id = Auth::user()->id;
        $correo = User::where('id', $id)->value('email');
        $cliente = Cliente::where('correo', $correo)->first();
        $cliente_id = $cliente->id;
        Pedido::create([
            'clientes_id' => $cliente_id,
            'fecha_inicio' => null,
            'fecha_entrega' => null,
            'estado_id' => 1, 
        ]);
        $id = Pedido::max('id');
        return redirect()->route('pedido-detallePedido', ['id' => $id]);
    }

    public function pedidoCliente()
    {
        //logica trambolica para usuarios y clientes
        $id = Auth::user()->id;
        $correo = User::where('id', $id)->value('email');
        $cliente = Cliente::where('correo', $correo)->first();
        $cliente_id = $cliente->id;

        //    dd($cliente);
        $pedidos = Pedido::where('clientes_id', $cliente_id)->get();


        return view('pedido.pedidoCliente', ['pedidos' => $pedidos]);
    }
    public function detallePedido(Request $request)
    {
        $id = $request->id;
        $estado = Pedido::where('id', $id)->value('estado_id');
        $producto = \Cart::getContent();
        foreach ($producto as $p) {
            $idPr = $p->id;
            detallePedido::create([
                'pedido_id' => $id,
                'producto_id' => $idPr,
                'cantidad' => $p->quantity,
                'subtotal' => \Cart::get($idPr)->getPriceSum(),
                'produccion' => false
            ]);
            $idDP = detallePedido::max('id');
            if ($p->attributes->disenio_estado == 'true') {
                $url_imagen = $p->attributes->url_disenio;
                Disenio::create([
                    'detallePedido_id' => $idDP,
                    'url_imagen' => $url_imagen,
                    'url_disenio' => "",
                    'disenio_estado' => 1,
                    'revision' => 0
                ]);
            } else {
                // dd();
                Disenio::create([
                    'detallePedido_id' => $idDP,
                    'url_imagen' => "",
                    'url_disenio' => "",
                    'disenio_estado' => 0,
                    'revision' => 0
                ]);
                Boceto::create([
                    'negocio' => $p->attributes->nombre,
                    'objetivo' => $p->attributes->objetivo,
                    'publico' => $p->attributes->publico,
                    'contenido' => $p->attributes->contenido,
                    'url_logo' => $p->attributes->logo,
                    'url_img' => $p->attributes->img,
                    'detallePedido_id' => $idDP
                ]);
            }
        }
        $total = \Cart::getTotal();
        // dd($total);
        \Cart::clear();
        return redirect()->route('pago', ['id' => $id, 'estado' => $estado, 'total' =>  $total]);
    }

    public function update(Request $request, Pedido $pedido)
    {
    
        $nuevoEstado = $request->estado;

        $estadosSecuenciales = ['pendiente_pago', 'confirmado_pago', 'inicio', 'disenio', 'pre_produccion', 'produccion', 'terminado', 'entregado'];

        if (in_array($nuevoEstado, $estadosSecuenciales)) {
            $estadoActualIndex = array_search($pedido->estado->nombre, $estadosSecuenciales);
            $nuevoEstadoIndex = array_search($nuevoEstado, $estadosSecuenciales);
            // dd([$estadoActualIndex, $nuevoEstadoIndex]);
            if ($nuevoEstadoIndex >= $estadoActualIndex) {
                // dd([$estadoActualIndex, $nuevoEstadoIndex]);

                $pedido = Pedido::find($pedido->id);
                $pedido->update(['estado_id' => $nuevoEstadoIndex + 1]);
                // return $pedido;
                if ($nuevoEstadoIndex == 4) {

                    event(new OrdenCompra());
                }

                return redirect()->route('pedidos.index')->with('success', 'Estado actualizado correctamente.');
            } else {
                return redirect()->route('pedidos.index')->with('error', 'No puedes retroceder a un estado anterior.');
            }
        } else {
            return redirect()->route('pedidos.index')->with('error', 'Estado no válido.');
        }
    }
}
