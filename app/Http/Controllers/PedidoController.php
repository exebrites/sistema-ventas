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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estadoCancelado = 11;
        $estadoEntregado = 10;
        $pedidos =  Pedido::where('estado_id', '!=', $estadoCancelado)->orderBy('estado_id', 'asc')->orderBy('id', 'desc')->get();
        foreach ($pedidos as $key => $pedido) {
            $fecha =  Carbon::parse($pedido->fecha_entrega);
            $pedido->fecha_entrega = $fecha->format('d-m-Y');

            if ($pedido->fecha_inicio != null) {
                $fecha =  Carbon::parse($pedido->fecha_inicio);
                $pedido->fecha_inicio = $fecha->format('d-m-Y');
            }
        }

        $pedidos = $pedidos->sortBy('estado_id');
        // dd($pedidos);
        return view('pedido.index', compact('pedidos'));
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
        $fecha =  Carbon::parse($pedido->fecha_inicio);
        $pedido->fecha_inicio = $fecha->format('d-m-Y');
        return view('pedido.show', compact('pedido'));
    }
    public function edit($id)
    {
        // return view('pedido.edit');
        $pedido = Pedido::find($id);
        return view('pedido.edit', ['pedido' => $pedido]);
    }


    //FIN DE FUNCIONES DE GESTIONAR PEDIDO

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
        //logica trambolica para usuarios y clientes
        $cliente = Cliente::obtenerCliente(Auth::user());

        //    dd($cliente);
        $pedidos = Pedido::where('clientes_id', $cliente->id)->orderBy('id', 'desc')->get();
        // dd($pedidos);
        foreach ($pedidos as $key => $pedido) {
            $fecha =  Carbon::parse($pedido->fecha_entrega);
            $pedido->fecha_entrega = $fecha->format('d-m-Y');
        }

        // dd("");
        return view('pedido.pedidoCliente', ['pedidos' => $pedidos]);
    }
    public function detallePedido(Request $request)
    {
        $id = $request->id;
        $pedido = Pedido::find($id);
        $estado_id = Pedido::where('id', $id)->value('estado_id');
        $estado =  Estado::find($estado_id);
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

            /**
             Bueno aqui tendré que replicar el codigo de crear detalle  
             
             */
            $idDP = detallePedido::max('id');
            $estadoDisenio = 1; //tiene disenio
            $revisionDisenio = null; // null indicando que se desconoce o todavia no esta para los estados validos
            // dump($p->attributes->disenio_estado);
            // dump(
            //     mb_strlen($p->attributes->nombre, 'UTF-8')
            // );

            // dump(
            //     mb_strlen($p->attributes->objetivo, 'UTF-8')
            // );
            // dump(
            //     mb_strlen($p->attributes->publico, 'UTF-8')
            // );
            // dump(
            //     mb_strlen($p->attributes->contenido, 'UTF-8')
            // );
            // dd("");
            if ($p->attributes->disenio_estado == 'true') {
                $url_imagen = $p->attributes->url_disenio;
                // dd($url_imagen);
                Disenio::create([
                    'detallePedido_id' => $idDP,
                    'url_imagen' => $url_imagen,
                    'url_disenio' => "",
                    'disenio_estado' => $estadoDisenio,
                    'revision' => $revisionDisenio
                ]);

                /**
                 *ELEGIR EL COSTO QUE EL CLIENTE DEBE PAGAR 
                 *
                  detallePedido::create([
                'pedido_id' => $id,
                'producto_id' => $idPr, =>  que será el diseño asistido
                'cantidad' => 1,
                'subtotal' => $$$$, => que será el costo del diseño asistido 
                'produccion' => false
            ]);
                 */
            } else {
                // dd();


                Disenio::create([
                    'detallePedido_id' => $idDP,
                    'url_imagen' => "",
                    'url_disenio' => "",
                    'disenio_estado' => 0,
                    'revision' =>    $revisionDisenio
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

                /**
                 *ELEGIR EL COSTO QUE EL CLIENTE DEBE PAGAR 
                 *
                  detallePedido::create([
                'pedido_id' => $id,
                'producto_id' => $idPr, =>  que será el diseño completo
                'cantidad' => 1,
                'subtotal' => $$$$, => que será el costo del diseño completo 
                'produccion' => false
            ]);
                 */
            }
        }
        $total = \Cart::getTotal();
        // dd($total);
        \Cart::clear();

        /**
         redireccionar a una vista intermedia anterior a realizar el pago
         
         */
        // return redirect()->route('pago', ['id' => $id, 'estado' => $estado, 'total' =>  $total]);





        $fecha =  Carbon::parse($pedido->fecha_entrega);
        $pedido->fecha_entrega = $fecha->format('d-m-Y');
        if ($pedido->fecha_inicio != null) {
            $fecha =  Carbon::parse($pedido->fecha_inicio);
            $pedido->fecha_inicio = $fecha->format('d-m-Y');
        }

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
