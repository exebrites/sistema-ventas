<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pedido;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class GraficoController extends Controller
{

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

        $pedidos = Pedido::whereBetween('created_at', [$fechaInicial, $fechaFinal])->get();
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
        return view('chart', ['data' => $puntos]);
    }
}
