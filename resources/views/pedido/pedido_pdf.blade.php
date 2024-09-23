<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Despacho</title>
    <style>
        /* body {
            font-family: sans-serif;
        } */


        .header {
            position: fixed;
            top: -2cm;
            /* left: 0cm;  */
        }

        .infoHeader {
            float: left;
            margin-left: 1cm;
        }

        .hijo {
            /* width: 2cm; */
            height: 1cm;
            margin: 0.2cm;

        }

        .imgHeader {
            float: left;
            width: 3cm;
            position: relative;
            margin-left: 0.4cm;
        }

        .header-otro {
            text-align: center;
            /* position: relative; */
        }

        .order-details,
        .delivery-info,
        .signature {
            margin-top: 20px;
        }

        .signature {
            height: 150px;
            border: 1px solid #000;
            text-align: center;
            padding-top: 100px;
        }
    </style>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>

<body>

    <div id="header">
        <div class="row">
            <div class="col-8">
                <img class="imgHeader" src="{{ public_path() . '/images/logo.png' }}" alt="" srcset="">
                <div class="infoHeader">
                    <h1>Oliva</h1>
                    <p>Diseño e impresión</p>
                </div>
            </div>
            <div class="col-4 infoHeader">
                <p style="margin-right: auto;">Dirección: {{ config('contacto.direccion') }} </p>
                <p style="margin-right: auto;">Teléfono: {{ config('contacto.telefono') }}</p>
                <p style="margin-right: auto;">Correo electrónico: {{ config('contacto.correo') }}</p>
            </div>
        </div>
    </div>
    <br>
    <br>

    <br>
    <br><br><br>
    <h1 class="header-otro">Detalle del Pedido para Despacho</h1>
    <div class="order-details">
        <h3>Pedido N°: {{ $pedido->id }}</h3>
        <p><strong>Cliente:</strong> {{ $pedido->cliente->nombre . ' ' . $pedido->cliente->apellido }}</p>
        <p><strong>Fecha de Despacho:</strong> {{ $fecha_despacho }}</p>
        <h4>Productos:</h4>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detalleProductos as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->name }}</td>
                        <td style="text-align: center;">{{ $detalle->cantidad }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="delivery-info">
        <h3>Información de Entrega</h3>

        {{-- {{ dd($entrega) }} --}}
        @if ($entrega->local)
            <p style="text-align: center;"><strong>RETIRO EN LOCAL</strong></p>
        @else
            <p><strong>Dirección de Entrega:</strong> {{ $entrega->direccion }}</p>
            <p><strong>Destinatario:</strong> {{ $entrega->recepcion }}</p>
            <p><strong>Telefono de contacto:</strong> {{ $entrega->telefono }}</p>
            <p><strong>Nota de Entrega:</strong> {{ $entrega->nota }}</p>
        @endif



    </div>

    <div class="signature">
        <p>Firma del Cliente</p>
    </div>

    <script type="text/php" >
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(275, 800, "Página $PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }
	</script>
</body>

</html>
