<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Oferta;
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
        $datos = [
            'proveedor' => $proveedor->nombre_contacto,
            'ordenCompra' => $ordenCompra->id,
            'fechaRecepcion' => $oferta->fecha_entrega,
            // Aquí podrías obtener los datos de los productos recibidos de tu base de datos o cualquier otra fuente de datos
            'productos' => [
                // ['nombre' => 'Producto 1', 'cantidadPedida' => 10, 'cantidadRecibida' => 10, 'observaciones' => ''],
                ['nombre' => $detallesOferta[0]->material->nombre, 'cantidadPedida' => $detalleOrdenCompra[0]->cantidad, 'cantidadEsperada' => $detallesOferta[0]->cantidad, 'cantidadRecibida' => '', 'observaciones' => ''],
            ]
        ];

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
}
