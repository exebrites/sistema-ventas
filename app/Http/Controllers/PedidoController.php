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
    const ESTADO_PENDIENTE_PAGO = 2;
    // const ESTADO_ENTREGADO = 10;
    const PENDIENTE =  1;

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

        // $fechaEntrega = $request->validated(['fechaEntrega']);
        $fechaEntrega = "2022-12-12";
        //traer el cliente segun su usuario logueado. No todos los usuarios son clientes
        $cliente = Cliente::obtenerCliente(Auth::user());
        //determina el costo del diseño asistido o completo
        // $costoDisenio = new CostoDisenio();
        // $productos  = \Cart::getContent();
        // $costoTotal = \Cart::getTotal() + $costoDisenio->costo_total_disenio($productos);

        $costoTotal = \Cart::getTotal();

        //crear un pedido cuyo estado es pendiente de confirmacion 
        $pedido = Pedido::create([
            'clientes_id' => $cliente->id,
            'fecha_inicio' => null,
            'fecha_entrega' => null,
            'estado_id' => self::PENDIENTE,
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
        $pedidos = Pedido::pedidosCliente($cliente); //llamado en calmeCase
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
                // 'produccion' => false
            ]);

            $estadoDisenio = 1; //tiene disenio
            $revisionDisenio = null; // null indicando que se desconoce o todavia no esta para los estados validos

            //asocia un diseño con el detalle pedido en caso de tener sino asocia un disenio vacio 
            // con su boceto
            // $disenio =  new Disenio();
            // $disenio->detallePedido_id = $detalle->id;
            // $disenio->url_disenio = "";
            // $disenio->revision = $revisionDisenio;
            if ($producto->attributes->disenio_estado == 'true') {
                //asocia el disenio con el detalle pedido y disenio estado tiene para revision
                // $disenio->url_imagen = $producto->attributes->url_disenio;
                // $disenio->disenio_estado = $estadoDisenio;
                // $disenio->save();
            } else {
                // $disenio->url_imagen = "";
                // $disenio->disenio_estado = 0;
                // $disenio->save();

                // Boceto::create([
                //     'negocio' => $producto->attributes->nombre,
                //     'objetivo' => $producto->attributes->objetivo,
                //     'publico' => $producto->attributes->publico,
                //     'contenido' => $producto->attributes->contenido,
                //     'url_logo' => $producto->attributes->logo,
                //     'url_img' => $producto->attributes->img,
                //     'detallePedido_id' => $detalle->id
                // ]);
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
        //cambiar el estado del pedido a cancelado
        $pedido = Pedido::find($id);
        $pedido->update(['estado_id' => self::ESTADO_CANCELADO]);
        $motivo = 'No especificado';
        // Envía el correo usando Mailable
        Mail::to($pedido->cliente->correo)->send(new PedidoCancelado($pedido, $motivo));

        return redirect()->route('shop')->with('success_msg', 'Su pedido ha sido cancelado con éxito');
    }
    public function confirmarPedido($id)
    {
        //recuperar el pedido y actualizar su estado
        $pedido = Pedido::find($id);
        $pedido->update(['estado_id' => self::ESTADO_PENDIENTE_PAGO]);
        $estado = $pedido->estado;

        //envio de correo al cliente con el id del pedido y su costo total
        Mail::to($$pedido->cliente->correo)->send(new PagoMailable($pedido->id, $pedido->costo_total));

        return view('checkout', compact('estado', 'pedido'));
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
