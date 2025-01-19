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
use App\Services\ProductoService;

/**
 * @OA\Info(
 *             title="Título que mostraremos en swagger", 
 *             version="1.0",
 *             description="Descripcion"
 * )
 *
 * @OA\Server(url="http://127.0.0.1:8000")
 */
class PedidoController extends Controller
{
    const PENDIENTE =  1;
    const ESTADO_CANCELADO = 3;

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
    public function creacion_pedido_detalles_pedido(PedidoService $pedidoService, ShoppingCartInterface $shoppingCart, ProductoService $productoService) //10 y 11 snake_case && nombre descriptivo
    {

        



        $productosCarrito = $shoppingCart->getContent();
        if ($productosCarrito->isEmpty()) {
            return back()->withErrors(['error' => 'El carrito está vacío.']);
        }

        foreach ($productosCarrito as $producto) {
            $resultado = $productoService->control_stock($producto, $producto->quantity);
            if ($resultado !== true) {
                return redirect()->back()->withErrors(['error' => $resultado]);
            }
        }
        $cliente = Cliente::obtenerCliente(Auth::user());
        if (!$cliente) {
            return back()->withErrors(['error' => 'El usuario no está asociado a un cliente.']);
        }
        $pedido = $pedidoService->crearPedido($cliente, $productosCarrito);
        $shoppingCart->clear();
        $estado = Estado::find(self::PENDIENTE);

        return view('checkout', [
            'pedido' => $pedido,
            'estado' => $estado
        ]);
    }
    public function pedidoCliente()
    {

        $cliente = Cliente::obtenerCliente(Auth::user());
        $pedidos = Pedido::pedidosCliente($cliente);
        return view('pedido.pedidoCliente', compact('pedidos'));
    }
    public function cancelarPedido(Pedido $pedido)
    {
        $pedido->update(['estado_id' => self::ESTADO_CANCELADO]);
        $motivo = 'No especificado';
        Mail::to($pedido->cliente->correo)->send(new PedidoCancelado($pedido, $motivo));
        return redirect()->route('shop')->with('success_msg', 'Su pedido ha sido cancelado con éxito');
    }
    public function update(Request $request, Pedido $pedido)
    {
        $nuevoEstado = $request->estado;
        $estado = Estado::where('nombre', $nuevoEstado)->first();
        if ($estado->id === SELF::ESTADO_CANCELADO) {
            $motivo = 'No especificado';
            Mail::to($pedido->cliente->correo)->send(new PedidoCancelado($pedido, $motivo));
        }
        $pedido->update([
            'estado_id' => $estado->id,
        ]);
        return redirect()->route('pedidos.index')->with('success', 'Actualizado correctamente.');
    }
}
