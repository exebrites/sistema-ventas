<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PedidoCancelado;

class PedidoController extends Controller
{
    const PENDIENTE =  1;
    const ESTADO_CANCELADO = 404;
    public function index()
    {
        // obtiene los pedidos que no tengan el estado cancelado y los ordena por estado 
        $pedidos = Pedido::activo()->get();
        return view('pedido.index', compact('pedidos'));
    }
    public function show(Pedido $pedido)
    {
        return view('pedido.show', compact('pedido'));
    }
    public function edit(Pedido $pedido)
    {
        return view('pedido.edit', compact('pedido'));
    }

    //Registrar pedido y relacionar con el cliente
    public function procesarPedido(Request $request)
    {
        /**
         MEJORA:
         * 1). Usar un ServiceProvider para crear el pedido y sus detalles
         * 2).  Agregar validaciones explícitas:
         *          Validar que el carrito no esté vacío.
         *          Validar que los productos existen y tienen stock suficiente.
         *          Validar que el usuario este autenticado y el cliente exista.
         * 
         * 3).Implementar manejo de excepciones con un bloque try-catch y transacciones para garantizar consistencia:
         * 4).Renombrar variables para mayor claridad
         * 5).Crear una capa de abstracción que encapsule el acceso al carrito
         * 6).Definicion de constantes
         * 7). Uso inadecuado de compact();Pasar los datos explícitamente
         * 8). Cargar las relaciones al momento de crear el pedido
         * 9). Buenas prácticas en nombres de clases
         * 10). snake_case para el nombre de metodos
         * 11). Nombre de metodos descriptivos
         * 
         */
        //traer el cliente segun su usuario logueado. No todos los usuarios son clientes


        // 2.1) Validar que el carrito no esté vacío.
        $productos = \Cart::getContent();
        if ($productos->isEmpty()) {
            return back()->withErrors(['error' => 'El carrito está vacío.']);
        }
        //2.3) Validar que el usuario este autenticado y el cliente exista.
        $cliente = Cliente::obtenerCliente(Auth::user());
        if (!$cliente) {
            return back()->withErrors(['error' => 'El usuario no está asociado a un cliente.']);
        }


        $costoTotal = \Cart::getTotal();
        $pedido = Pedido::create([
            'clientes_id' => $cliente->id,
            'fecha_inicio' => null,
            'fecha_entrega' => null,
            'estado_id' => self::PENDIENTE,
            'costo_total' => $costoTotal
        ]);
        //creacion de detalles de pedido con los productos del carrito

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
    public function cancelarPedido(Pedido $pedido)
    {

        /**
         MEJORA:
         * 1). Usar inyeccion de dependencias para traer el pedido
         */
        $pedido->update(['estado_id' => self::ESTADO_CANCELADO]);
        $motivo = 'No especificado';
        // Envía el correo usando Mailable
        Mail::to($pedido->cliente->correo)->send(new PedidoCancelado($pedido, $motivo));
        return redirect()->route('shop')->with('success_msg', 'Su pedido ha sido cancelado con éxito');
    }
    public function update(Request $request, Pedido $pedido)
    {
        $nuevoEstado = $request->estado;
        $estado = Estado::where('nombre', $nuevoEstado)->first();
        //enviar correo de cancelacion
        if ($estado->id === SELF::ESTADO_CANCELADO) {
            $motivo = 'No especificado';
            // Envía el correo usando Mailable
            Mail::to($pedido->cliente->correo)->send(new PedidoCancelado($pedido, $motivo));
        }
        //actualizar estado del pedido y fecha de inicio
        $pedido->update([
            'estado_id' => $estado->id,
        ]);
        return redirect()->route('pedidos.index')->with('success', 'Actualizado correctamente.');
    }
}
