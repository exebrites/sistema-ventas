<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Boceto;
use App\Models\Estado;
use App\Models\Oferta;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Disenio;
use App\Mail\PagoMailable;
use App\Events\OrdenCompra;
use App\Http\Requests\ProcesarPedidoRequest;
use App\Mail\ConfirmacionImprenta;
use App\Mail\ConfirmacionPago;
use Darryldecode\Cart\Cart;
use App\Mail\EstadoMailable;
use App\Mail\PagoPendiente;
use App\Models\CostoDisenio;
use Illuminate\Http\Request;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Mail\PedidoCancelado;
use App\Models\Demanda;
use App\Mail\confirmacionEntrega;

class PedidoController extends Controller
{

    const ESTADO_CANCELADO = 11;
    // const ESTADO_ENTREGADO = 10;
    public function index()
    {
        // obtiene los pedidos que no tengan el estado cancelado y los ordena por estado 
        $pedidos = Pedido::activo();
        return view('pedido.index', compact('pedidos'));
    }
    public function show($id)
    {
        $pedido = Pedido::find($id);
        return view('pedido.show', compact('pedido'));
    }
    public function edit($id)
    {
        $pedido = Pedido::find($id);
        return view('pedido.edit', compact('pedido'));
    }

    //Registrar pedido y relacionar con el cliente
    public function procesarPedido(ProcesarPedidoRequest $request)
    {

        $fechaEntrega = $request->validated(['fechaEntrega']);
        //traer el cliente segun su usuario logueado. No todos los usuarios son clientes
        $cliente = Cliente::obtenerCliente(Auth::user());

        //determina el costo del diseño asistido o completo
        $costoTotal = \Cart::getTotal() + CostoDisenio::costo_total_disenio();
        $estado =  1;

        //crear un pedido cuyo estado es pendiente de confirmacion 
        $pedido = Pedido::create([
            'clientes_id' => $cliente->id,
            'fecha_inicio' => null,
            'fecha_entrega' => $fechaEntrega,
            'estado_id' => $estado,
            'costo_total' => $costoTotal
        ]);

        //traer el ultimo pedido creado y lo envia al metodo detallePedido
        return redirect()->route('pedido-detallePedido', ['id' => $pedido->id]);
    }

    public function pedidoCliente()
    {
        //obtener el cliente logueado
        $cliente = Cliente::obtenerCliente(Auth::user());

        //obtener los pedidos del cliente ordenados por id
        $pedidos = Pedido::where('clientes_id', $cliente->id)->orderBy('id', 'desc')->get();

        //formatear la fecha 
        foreach ($pedidos as $key => $pedido) {
            $fecha =  Carbon::parse($pedido->fecha_entrega);
            $pedido->fecha_entrega = $fecha->format('d-m-Y');
        }
        
        return view('pedido.pedidoCliente', compact('pedidos'));
    }
    public function detallePedido(Request $request)
    {
        //recupera el ultimo pedido creado y su estado. 
        $pedido = Pedido::find($request->id);
        $estado =  $pedido->estado;

        //recuper los productos del carrito y crea 1 detalle por producto asociandolo al pedido
        $productos = \Cart::getContent();
        foreach ($productos as $producto) {
            $detalle = detallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $producto->id,
                'cantidad' => $producto->quantity,
                'subtotal' => \Cart::get($producto->id)->getPriceSum(),
                'produccion' => false
            ]);

            $estadoDisenio = 1; //tiene disenio
            $revisionDisenio = null; // null indicando que se desconoce o todavia no esta para los estados validos

            //asocia un diseño con el detalle pedido en caso de tener sino asocia un disenio vacio 
            // con su boceto
            $disenio =  new Disenio();
            $disenio->detallePedido_id = $detalle->id;
            $disenio->url_disenio = "";
            $disenio->revision = $revisionDisenio;
            if ($producto->attributes->disenio_estado == 'true') {
                //asocia el disenio con el detalle pedido y disenio estado tiene para revision
                $disenio->url_imagen = $producto->attributes->url_disenio;
                $disenio->disenio_estado = $estadoDisenio;
                $disenio->save();
            } else {
                $disenio->url_imagen = "";
                $disenio->disenio_estado = 0;
                $disenio->save();

                Boceto::create([
                    'negocio' => $producto->attributes->nombre,
                    'objetivo' => $producto->attributes->objetivo,
                    'publico' => $producto->attributes->publico,
                    'contenido' => $producto->attributes->contenido,
                    'url_logo' => $producto->attributes->logo,
                    'url_img' => $producto->attributes->img,
                    'detallePedido_id' => $detalle->id
                ]);
            }
        }
        //obtiene el costo total del carrito y borra el carrito 
        $total = \Cart::getTotal();
        \Cart::clear();

        //Da un formato dd/mm/yyyy a la fecha de entrega  y de inicio
        // $fecha =  Carbon::parse($pedido->fecha_entrega);
        // $pedido->fecha_entrega = $fecha->format('d-m-Y');
        // $pedido->fecha_entrega = $pedido->formato_fecha_entrega;
        // if ($pedido->fecha_inicio != null) {
        //     $fecha =  Carbon::parse($pedido->fecha_inicio);
        //     $pedido->fecha_inicio = $fecha->format('d-m-Y');
        // }
        return view('checkout', compact('estado', 'pedido'));
    }

    public function cancelarPedido($id)
    {
        $estado = 11;
        $pedido = Pedido::find($id);
        $pedido->update(['estado_id' => $estado]);
        //enviar correo
        $usuario = $pedido->cliente;  // Asumiendo que el pedido tiene una relación con el usuario
        $motivo = 'No especificado';

        // Envía el correo usando Mailable
        Mail::to($usuario->correo)->send(new PedidoCancelado($pedido, $motivo));


        return redirect()->route('shop')->with('success_msg', 'Su pedido ha sido cancelado con éxito');
    }
    public function confirmarPedido($id)
    {
        $estado = 2;
        $pedido = Pedido::find($id);
        $pedido->update(['estado_id' => $estado]);
        $estado = Estado::find($pedido->estado_id);


        $total = $pedido->costo_total;

        $cliente = $pedido->cliente;
        $correo = $cliente->correo;
        // dd($correo);
        Mail::to($correo)->send(new PagoMailable($id, $total));

        return view('checkout', compact('estado', 'pedido'));
    }

    public function update(Request $request, Pedido $pedido)
    {

        // return "hola";
        $pedido = Pedido::find($request->pedido_id);
        $nuevoEstado = $request->estado;
        $estado = Estado::where('nombre', $nuevoEstado)->first();
        $usuario = $pedido->cliente;
        if ($estado->id != 6) {

            if ($estado->id === 1) {
                Mail::to($usuario->correo)->send(new ConfirmacionImprenta($pedido, $usuario));
            }
            // if ($estado->id === 2) {
            //     return "pendiente de pago";
            //     Mail::to($usuario->correo)->send(new PagoPendiente($pedido));
            // }
            if ($estado->id === 3) {
                // antes de confirmar el pago verificar si existe un comprobante

                if ($pedido->comprobante == null) {
                    return redirect()->route('pedidos.index')->with('error', 'No se puede pasar al siguiente estado. No existe un comprobante de pago para el pedido.');
                }
                // return "confirmacion de pago ";
                Mail::to($usuario->correo)->send(new ConfirmacionPago($pedido, $usuario));
            }
            if ($estado->id === 10) {
                Mail::to($usuario->correo)->send(new ConfirmacionEntrega($pedido, $usuario));
            }
            if ($estado->id === 11) {
                //enviar correo
                $usuario = $pedido->cliente;  // Asumiendo que el pedido tiene una relación con el usuario
                $motivo = 'No especificado';

                // Envía el correo usando Mailable
                Mail::to($usuario->correo)->send(new PedidoCancelado($pedido, $motivo));
            }
            $pedido->update([
                'estado_id' => $estado->id,
                'fecha_inicio' => $request->fecha_e
            ]);
            return redirect()->route('pedidos.index')->with('success', 'Actualizado correctamente.');
        } else {
            // dd("hola");
            $oferta = Oferta::where('estado', 'pendiente')->latest()->first();
            $demanda =  Demanda::where('estado', 'confirmado')->latest()->first();

            // // dd();
            // if ($demanda->oferta === null) {
            //     # code...

            //     return redirect()->route('pedidos.index')->with('error', 'No podes agregar mas pedidos a pre produccion, tenes una demanda sin ofertas.');
            // }
            if ($oferta) {
                return redirect()->route('pedidos.index')->with('error', 'No podes agregar mas pedidos a pre produccion, tenes ofertas pendientes.');
            } else {


                // segun el pedido tengo que traer todo los detalles aprobados 


                // solo pasar a preproduccion si todos los detalles tienen aprobado 
                $aprobado  = 0;
                // $noAprobado = 0;
                $totalDetalle = count($pedido->detallePedido);
                foreach ($pedido->detallePedido as $detalle) {
                    if ($detalle->produccion) {
                        $aprobado++;
                    }
                }

                if (($totalDetalle - $aprobado) == 0) {
                    $pedido->update([
                        'estado_id' => $estado->id,
                        'fecha_inicio' => $request->fecha_e
                    ]);
                    event(new OrdenCompra());
                    return redirect()->route('pedidos.index')->with('success', 'Actualizado correctamente.');
                } else {
                    return redirect()->route('pedidos.index')->with('error', 'Tenes diseños pendientes de aprobación');
                }
            }
        }
    }
}
