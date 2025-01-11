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
use Svg\Tag\Rect;

class PedidoController extends Controller
{
    const PENDIENTE =  1;
    const ESTADO_CANCELADO = 404;
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
    public function procesarPedido(Request $request)
    {
        //traer el cliente segun su usuario logueado. No todos los usuarios son clientes
        $cliente = Cliente::obtenerCliente(Auth::user());
        $costoTotal = \Cart::getTotal();
        $pedido = Pedido::create([
            'clientes_id' => $cliente->id,
            'fecha_inicio' => null,
            'fecha_entrega' => null,
            'estado_id' => self::PENDIENTE,
            'costo_total' => $costoTotal
        ]);
        //creacion de detalles de pedido con los productos del carrito
        $productos = \Cart::getContent();
        foreach ($productos as $producto) {
            $detalle = detallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $producto->id,
                'cantidad' => $producto->quantity,
                'subtotal' => \Cart::get($producto->id)->getPriceSum(),
            ]);
        }
        \Cart::clear();
        $estado = Estado::find(self::PENDIENTE);
        return view('checkout', compact('estado', 'pedido'));
    }
    public function pedidoCliente()
    {
        //obtener el cliente logueado
        $cliente = Cliente::obtenerCliente(Auth::user());
        //obtener los pedidos del cliente ordenados por id
        $pedidos = Pedido::pedidosCliente($cliente);
        return view('pedido.pedidoCliente', compact('pedidos'));
    }
    public function cancelarPedido($id)
    {
        $pedido = Pedido::find($id);
        $pedido->update(['estado_id' => self::ESTADO_CANCELADO]);
        $motivo = 'No especificado';
        // Envía el correo usando Mailable
        Mail::to($pedido->cliente->correo)->send(new PedidoCancelado($pedido, $motivo));
        return redirect()->route('shop')->with('success_msg', 'Su pedido ha sido cancelado con éxito');
    }
    public function update(Request $request, Pedido $pedido)
    {

        //recuperar el pedido, el estado y el cliente
        $pedido = Pedido::find($request->pedido_id);
        $nuevoEstado = $request->estado;
        $estado = Estado::where('nombre', $nuevoEstado)->first();
        $usuario = $pedido->cliente;


        //determinar si esta en preproduccion
        if ($estado->id != 6) {
            //enviar correo de confirmacion de imprenta
            if ($estado->id === 1) {
                Mail::to($usuario->correo)->send(new ConfirmacionImprenta($pedido, $usuario));
            }

            //enviar correo de confirmacion de pago
            if ($estado->id === 3) {
                // antes de confirmar el pago verificar si existe un comprobante
                if ($pedido->comprobante == null) {
                    return redirect()->route('pedidos.index')->with('error', 'No se puede pasar al siguiente estado. No existe un comprobante de pago para el pedido.');
                }
                Mail::to($usuario->correo)->send(new ConfirmacionPago($pedido, $usuario));
            }

            //enviar correo de confirmacion de entrega
            if ($estado->id === 10) {
                Mail::to($usuario->correo)->send(new ConfirmacionEntrega($pedido, $usuario));
            }

            //enviar correo de cancelacion
            if ($estado->id === 11) {
                //enviar correo
                $usuario = $pedido->cliente;  // Asumiendo que el pedido tiene una relación con el usuario
                $motivo = 'No especificado';

                // Envía el correo usando Mailable
                Mail::to($usuario->correo)->send(new PedidoCancelado($pedido, $motivo));
            }

            //actualizar estado del pedido y fecha de inicio
            $pedido->update([
                'estado_id' => $estado->id,
                'fecha_inicio' => $request->fecha_e
            ]);

            return redirect()->route('pedidos.index')->with('success', 'Actualizado correctamente.');
        } else {
            //pedido en preproduccion

            //recuperar la oferta y la demanda ultimas
            $oferta = Oferta::where('estado', 'pendiente')->latest()->first();
            $demanda =  Demanda::where('estado', 'confirmado')->latest()->first();

            //si existe una oferta pendiente no se puede pasar a preproduccion
            if ($oferta) {
                return redirect()->route('pedidos.index')->with('error', 'No podes agregar mas pedidos a pre produccion, tenes ofertas pendientes.');
            } else {
                // solo pasar a preproduccion si todos los detalles tienen aprobado 
                $aprobado  = 0;
                // $noAprobado = 0;
                //determinar el numero de detalles por producto y disenios aprobados
                $totalDetalle = count($pedido->detallePedido);
                foreach ($pedido->detallePedido as $detalle) {
                    if ($detalle->produccion) {
                        $aprobado++;
                    }
                }

                //si todos los detalles tienen aprobado pasar a preproduccion
                if (($totalDetalle - $aprobado) == 0) {
                    $pedido->update([
                        'estado_id' => $estado->id,
                        'fecha_inicio' => $request->fecha_e
                    ]);

                    //generar orden de compra
                    event(new OrdenCompra());
                    return redirect()->route('pedidos.index')->with('success', 'Actualizado correctamente.');
                } else {
                    return redirect()->route('pedidos.index')->with('error', 'Tenes diseños pendientes de aprobación');
                }
            }
        }
    }
}
