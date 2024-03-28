<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
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
        <div class="row">
            <div class="col-8">
                <img class="imgHeader" src="{{ public_path() . '/images/images.png' }}" alt="" srcset="">
                <div class="infoHeader">
                    <h1>Oliva</h1>
                    <p>Disenio e impresión</p>
                </div>
            </div>
            <div class="col-4 infoHeader">
                <p style="margin-right: auto;">Dirección: {{ config('contacto.direccion') }} </p>
                <p style="margin-right: auto;">Teléfono: {{ config('contacto.telefono') }}</p>
                <p style="margin-right: auto;">Correo electrónico: {{ config('contacto.correo') }}</p>
            </div>
        </div>
    </div>
    <div id="footer">


        {{-- <p class="textFooter">laravel</p> --}}
    </div>



    <h1>Factura # {{ $factura_id }}</h1>

    <p>Fecha de emisión:{{ $fecha }} </p>
    <div class="row">
        <div class="col-6">
            <h2>Cliente</h2>
            <p>Nombre:{{ $cliente['nombre'] }}</p>
            {{-- <p>Dirección:{{ $cliente['direccion'] }}</p> --}}
            <p>Apellido:{{ $cliente['apellido'] }}</p>
            <p>Documento:{{ $cliente['dni'] }}</p>
            <p>Telefono:{{ $cliente['telefono'] }}</p>
        </div>
        <div class="col-6">
            <h2>Vendedor</h2>
            <p>Nombre: {{ $vendedor['nombre'] }}</p>
            <p>Dirección: {{ $vendedor['direccion'] }}</p>
            <p>Telefono: {{ $vendedor['telefono'] }}</p>
        </div>
    </div>





    <h2>Productos/Servicios</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto['nombre'] }}</td>
                    <td>{{ $producto['cantidad'] }}</td>
                    <td>{{ $producto['precio'] }}</td>
                    <td>{{ $producto['subtotal'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td>Servicios de diseño</td>
                <td>-</td>
                <td></td>
                <td>{{ $servicios }}</td>
            </tr>
        </tbody>
    </table>

    <h2>Resumen</h2>

    <p><b>Total: {{ $total }}</b></p>


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
