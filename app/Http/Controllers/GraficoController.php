<?php

namespace App\Http\Controllers;

use Svg\Tag\Rect;
use Carbon\Carbon;
use App\Models\Pedido;
use GuzzleHttp\Client;
use App\Models\Cliente;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Illuminate\Validation\ValidationException;

class GraficoController extends Controller
{

    public function indexCliente()
    {
        $clientes = Cliente::all();
        return view('index_grafico_cliente', compact('clientes'));
    }
    public function graficoCliente(Request $request)
    {
        // return $request;
        try {
            $request->validate([
                'inicio' => [
                    'required',
                    'before:' . $request->final,
                ],
                'final' => 'required',
            ]);
        } catch (ValidationException $e) {
            // Manejar los errores de validación aquí
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $fechaInicial = $request->inicio;
        $fechaFinal = $request->final;
        $fechaInicial = Carbon::parse($fechaInicial);
        $fechaFinal = Carbon::parse($fechaFinal);
        $cliente = Cliente::find($request->cliente_id);
        $pedidos = Pedido::whereBetween('created_at', [$fechaInicial, $fechaFinal->addDays(1)])->where('clientes_id', $cliente->id)->get();
        $pedidoCancelados =  Pedido::whereBetween('created_at', [$fechaInicial, $fechaFinal])->where('clientes_id', $cliente->id)->where('estado_id', 11)->get();
        $data = [
            'name' => 'cancelado', 'data' => count($pedidoCancelados),
        ];
        $dataNoCancelado = ['name' => 'Nocancelado', 'data' => count($pedidos)];
        $data = json_encode($data);
        $dataNoCancelado = json_encode($dataNoCancelado);
        $fechaFinal->subDays(1);
        return view('grafico_cliente', compact('data', 'dataNoCancelado', 'cliente', 'fechaInicial', 'fechaFinal'));
    }



    public function index()
    {
        return view('prueba');
    }
    public function graficoBarra(Request $request)
    {
        // return $request->inicio;



        try {
            $request->validate([
                'inicio' => [
                    'required',
                    'before:' . $request->final,
                ],
                'final' => 'required',
            ]);
        } catch (ValidationException $e) {
            // Manejar los errores de validación aquí
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $fechaInicial = $request->inicio;
        // $fechaFinal = Carbon::today();
        $fechaFinal = $request->final;
        $fechaInicial = Carbon::parse($fechaInicial);
        $fechaFinal = Carbon::parse($fechaFinal);

        $pedidos = Pedido::whereBetween('created_at', [$fechaInicial, $fechaFinal->addDays(1)])->get();
        // dd($pedidos);
        // // Agrupar los productos por nombre y obtener la cantidad total vendida

        if (!isset($pedidos)) {
            return "pedido vacios";
        }
        $productos = [];
        foreach ($pedidos as $key => $pedido) {
            foreach ($pedido->detallePedido as $key => $detalle) {
                $productos[] = [
                    'id' => $detalle->producto->id,
                    'name' => $detalle->producto->name,
                    'y' => $detalle->cantidad
                ];
            }
        }

        $resultado = array_reduce($productos, function ($agrupados, $producto) {
            $id = $producto['id'];
            $nombre = $producto['name'];
            $cantidad = $producto['y'];

            // Si el ID no existe en el array agrupado, lo agregamos
            if (!isset($agrupados[$id])) {
                $agrupados[$id] = ['id' => $id, 'name' => $nombre, 'y' => 0];
            }

            // Sumamos la cantidad al total para el ID
            $agrupados[$id]['y'] += $cantidad;

            return $agrupados;
        }, []);


        $puntos = [];
        foreach ($resultado as $key => $material) {

            $puntos[] = ["name" => $material['name'], "y" => floatval($material['y'])];
            # code...
        }

        // dd([$resultado, $puntos]);
        $puntos = json_encode($puntos);
        return view('chart', ['data' => $puntos], compact('fechaInicial', 'fechaFinal'));
    }
}
