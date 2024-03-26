<!DOCTYPE html>
<html>

<head>
    <title>Control de Recepción de Productos</title>
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
    <style>
        @page {
            margin: 3.5cm 0.5cm 1cm 0.5cm;
        }

        #header {
            position: fixed;
            top: -3.5cm;
            left: 0cm;
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

        }

        #footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            width: 100%;
            background-color: red;
        }

        .textFooter {
            text-align: center;
            width: 100%;
        }

        .hijo {
            width: 2cm;
            height: 1cm;
            margin: 0.2cm;
        }
    </style>
</head>

<body>
    {{-- {{ dd($datos) }} --}}
    <div id="header">
        <img class="imgHeader" src="{{ public_path('cosito') }}" alt="" srcset="">
        <div class="infoHeader">
            <h1>Laravel</h1>
            <p>Un framework para php</p>

        </div>
    </div>
    <div id="footer">


        {{-- <p class="textFooter">laravel</p> --}}
    </div>


    {{-- <div class="conteiner">
        @for ($i = 0; $i < 40; $i++)
            <div class="hijo">
                {{$i}}
            </div>
        @endfor
    </div> --}}
    <h2>Control de Recepción de producto</h2>
    <p><strong>Proveedor:</strong> {{ $proveedor }}</p>
    <p><strong>Orden de Compra #:</strong> {{ $ordenCompra }}</p>
    <p><strong>Fecha de Recepción:</strong> {{ $fechaRecepcion }}</p>

    <table>
        <tr>
            <th>Nº</th>
            <th>Producto</th>
            <th>Cantidad Pedida</th>
            <th>Cantidad Esperada</th>
            <th>Cantidad Recibida</th>
            <th>Observaciones</th>
        </tr>

        @foreach ($productos as $index => $producto)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $producto['nombre'] }}</td>
                <td>{{ $producto['cantidadPedida'] }}</td>
                <td>{{ $producto['cantidadEsperada'] }}</td>
                <td>{{ $producto['cantidadRecibida'] }}</td>
                <td>{{ $producto['observaciones'] }}</td>
            </tr>
        @endforeach

    </table>



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
