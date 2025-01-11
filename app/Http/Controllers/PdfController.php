<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Oferta;
use App\Models\Pedido;
use App\Models\Demanda;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;


class PdfController extends Controller
{

    // use Barryvdh\DomPDF\Facade as PDF;

    public function generarPDFDespacho($pedido_id)
    {

        // $pedido = Pedido::with(['cliente', 'productos'])->findOrFail($pedidoId);
        $pedido = Pedido::find($pedido_id);
        $detalleProductos = $pedido->detallesPedido;
        $fecha_despacho = now()->format('d-m-Y H:i:s');
        $entrega = $pedido->entrega[0];
        // dd($entrega);
        $pdf = Pdf::loadView('pedido.pedido_pdf', compact('pedido','detalleProductos','fecha_despacho','entrega'));

        return $pdf->download('pedido_despacho_' . $pedido->id . '.pdf');
        // return $pdf->stream();
    }


    public function index()
    {
        return view('prueba');
    }
    public function generarPDF($id)
    {
        $oferta = Oferta::find($id);


        $ordenCompra = $oferta->demanda;
        // dd($ordenCompra);
        $detalleOrdenCompra = $ordenCompra->detalleDemandas;
        // dd($ofertas);

        // dd($ordenCompra);
        $proveedor = $oferta->proveedor;
        $detallesOferta =   $oferta->detalleOferta;
        // Obtener los datos necesarios para el formulario de control de recepción de productos
        $fecha =  Carbon::parse($oferta->fecha_entrega);
        $oferta->fecha_entrega = $fecha->format('d-m-Y');


        $long =  2;
        for ($i = 0; $i < $long; $i++) {
            $productos[] =
                [
                    'nombre' => $detallesOferta[$i]->material->nombre,
                    'cantidadPedida' => $detalleOrdenCompra[$i]->cantidad,
                    'cantidadEsperada' => $detallesOferta[$i]->cantidad,
                    'cantidadRecibida' => '',
                    'observaciones' => ''
                ];
        }

        // return $productos;
        $datos = [
            'proveedor' => $proveedor->nombre_contacto,
            'ordenCompra' => $ordenCompra->id,
            'fechaRecepcion' => $oferta->fecha_entrega,
            // Aquí podrías obtener los datos de los productos recibidos de tu base de datos o cualquier otra fuente de datos
            'productos' => $productos
        ];

        // return $datos['productos'][0]['nombre'];
        $pdf = Pdf::loadView('control_recepcion_pdf', $datos);
        // return $pdf->download('control_recepcion_pdf.pdf');
        return $pdf->stream();
        // Renderizar la vista con los datos
        // $html = View::make('control_recepcion_pdf', $datos)->render();
        // // Agregar pie de página con el nombre de la empresa
        // // $html .= '<div style="position: fixed; bottom: 0; width: 100%; text-align: center;">Diseño Oliva</div>';

        // // dd($html);
        // // Crear una instancia de DOMPDF y cargar el HTML generado
        // $dompdf = new Dompdf();
        // $dompdf->loadHtml($html);

        // // Opcional: establecer opciones de configuración (tamaño de página, orientación, etc.)
        // $dompdf->setPaper('A4', 'portrait');

        // // Renderizar el PDF
        // $dompdf->render();

        // // Enviar el PDF al navegador para su descarga
        // return $dompdf->stream('control_recepcion_productos.pdf', array('Attachment' => false));
    }

    public function generarFactura($pedido_id)
    {
        $pedido = Pedido::find($pedido_id);
        $total = 0;
        foreach ($pedido->detallePedido as $key => $detalle) {
            $total = $total +  $detalle->cantidad * $detalle->producto->price;
            $productos[] = [
                'nombre' => $detalle->producto->name,
                'cantidad' => $detalle->cantidad,
                'precio' => $detalle->producto->price,
                'subtotal' =>  $detalle->cantidad * $detalle->producto->price
            ];
        }
        $factura_id = $pedido->id;
        $fecha_creacion = Carbon::today()->format('d-m-Y');
        $cliente =  $pedido->cliente;
        $datos = [
            'factura_id' => $factura_id,
            'fecha' => $fecha_creacion,
            'cliente' => [
                'nombre' => $cliente->nombre,
                'apellido' => $cliente->apellido,
                'dni' => $cliente->dni,
                'telefono' => $cliente->telefono
                // 'direccion' => isset($pedido->entrega)?$pedido->entrega->direc'calle sin nombre',
            ],
            'vendedor' => [
                'nombre' => config('contacto.nombre'),
                'direccion' => config('contacto.direccion'),
                'telefono' => config('contacto.telefono')
            ],
            'productos' => $productos,
            'total' => $pedido->costo_total,
            'servicios' => $pedido->costo_total - $total

        ];
        $pdf = Pdf::loadView('factura', $datos);
        // return $pdf->download('control_recepcion_pdf.pdf');
        return $pdf->download('factura' . $pedido->id . '.pdf');

    }
}
