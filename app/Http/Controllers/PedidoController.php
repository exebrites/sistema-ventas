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
use App\Models\Producto;
use App\Services\PedidoService;
use App\Contracts\ShoppingCartInterface;

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
    public function creacion_pedido_detalles_pedido(PedidoService $pedidoService, ShoppingCartInterface $shoppingCart) //10 y 11 snake_case && nombre descriptivo
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

        // 1). Usar un ServiceProvider para crear el pedido y sus detalles
        // 2.1) Validar que el carrito no esté vacío.
        // $productosCarrito = \Cart::getContent();
        $productosCarrito = $shoppingCart->getContent();
        if ($productosCarrito->isEmpty()) {
            return back()->withErrors(['error' => 'El carrito está vacío.']);
        }

        //2.2) Validar que los productos existen y tienen stock suficiente.PENDIENTE
        foreach ($productosCarrito as $producto) {
            // $productoDB = Producto::find($producto->id);
            // if (!$productoDB) {
            //     return back()->withErrors(['error' => 'El producto no existe.']);
            // }
            // if ($producto->quantity > $productoDB->stock) {
            //     return back()->withErrors(['error' => 'El producto no tiene stock suficiente.']);
            // }
            // $productoDB->decrement('stock', $producto->quantity);
        }
        //2.3) Validar que el usuario este autenticado y el cliente exista.
        $cliente = Cliente::obtenerCliente(Auth::user());
        if (!$cliente) {
            return back()->withErrors(['error' => 'El usuario no está asociado a un cliente.']);
        }
        // 3).Implementar manejo de excepciones con un bloque try-catch y transacciones para garantizar consistencia:
        $pedido = $pedidoService->crearPedido($cliente, $productosCarrito);
        // 4).Renombrar variables para mayor claridad
        // 5).Crear una capa de abstracción que encapsule el acceso al carrito
        $shoppingCart->clear();
        $estado = Estado::find(self::PENDIENTE);

        // 7 - Uso inadecuado de compact();Pasar los datos explícitamente
        return view('checkout', [
            'pedido' => $pedido,
            'estado' => $estado
        ]);
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
