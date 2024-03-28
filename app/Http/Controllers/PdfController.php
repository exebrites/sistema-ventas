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

    public function generarFactura()
    {
        // Importamos las librerías necesarias
        // Datos de la factura
        // $customer = [
        //     'name' => 'Cliente 1',
        //     'address' => 'Dirección del cliente',
        //     'tax_id' => '1234567890',
        // ];

        $products = [
            [
                'name' => 'Producto 1',
                'quantity' => 1,
                'price' => 100,
            ],
            [
                'name' => 'Producto 2',
                'quantity' => 2,
                'price' => 50,
            ],
        ];

        // Calculamos el total
        $total = 0;
        foreach ($products as $product) {
            $total += $product['quantity'] * $product['price'];
        }

        $pedido_id = 30;
        $pedido = Pedido::find($pedido_id);
        foreach ($pedido->detallePedido as $key => $detalle) {
            $productos[] = [
                'nombre' => $detalle->producto->name,
                'cantidad' => $detalle->cantidad,
                'precio' => $detalle->producto->price,
                'subtotal' =>  $detalle->cantidad * $detalle->producto->price
            ];
        }
        // dd($productos);
        $factura_id = $pedido->id;
        $fecha_creacion = Carbon::today();

        $datos = [
            'factura_id' => $factura_id,
            'fecha' => $fecha_creacion,
            'cliente' => [
                'nombre' => 'Cliente 1',
                'direccion' => 'Dirección del cliente',
            ],
            'vendedor' => [
                'nombre' => config('contacto.nombre'),
                'direccion' => config('contacto.direccion'),
                'telefono' => config('contacto.telefono')
            ],
            'productos' => $productos,

        ];
        $pdf = Pdf::loadView('factura', $datos);
        // return $pdf->download('control_recepcion_pdf.pdf');
        return $pdf->stream();


        // Generamos el contenido HTML de la factura
        $html = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
</head>
<body>
    <h1>Factura</h1>

    <p>Cliente:</p>
    <ul>
        <li>Nombre: ' . $customer['name'] . '</li>
        <li>Dirección: ' . $customer['address'] . '</li>
        <li>Cédula/RIF: ' . $customer['tax_id'] . '</li>
    </ul>

    <table border="1">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($products as $product) {
            $html .= '
            <tr>
                <td>' . $product['name'] . '</td>
                <td>' . $product['quantity'] . '</td>
                <td>' . $product['price'] . '</td>
            </tr>';
        }
        $html .= '
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <td>' . $total . '</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>';

        // Creamos una instancia de Dompdf
        $dompdf = new Dompdf();

        // Cargamos el contenido HTML
        $dompdf->loadHtml($html);

        // Renderizamos el PDF
        $dompdf->render();

        // Guardamos el PDF en el almacenamiento
        // $pdf = $dompdf->output();
        // Storage::put('public/facturas/factura.pdf', $pdf);

        // Redirigimos al usuario a la página de descarga
        return $dompdf->stream();

        return "hola";
    }
}
