{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
        <h1>Factura #{{ $invoice->id }}</h1>

        <p>Fecha: {{ $invoice->created_at->format('d/m/Y') }}</p>

        <h2>Cliente</h2>
        <p>Nombre: {{ $invoice->customer->name }}</p>
        <p>Dirección: {{ $invoice->customer->address }}</p>
        {{-- <p>RFC / Cédula: {{ $invoice->customer->tax_id }}</p>

        <h2>Vendedor</h2>
        <p>Nombre: {{ config('app.name') }}</p>
        <p>Dirección: {{ config('app.address') }}</p>


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
                @foreach ($invoice->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ number_format($product->price, 2) }}</td>

                        <td>{{ number_format($product->quantity * $product->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Resumen</h2>
        <p>Subtotal: {{ number_format($invoice->subtotal, 2) }}</p>
        <p>Impuesto: {{ number_format($invoice->tax, 2) }}</p>
        <p><b>Total: {{ number_format($invoice->total, 2) }}</b></p>

    @endsection


</body>

</html> --}}
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
        <br>

        <img class="imgHeader" src="{{ public_path() . '/images/images.png' }}" alt="" srcset="">
        <div class="infoHeader">
            <h1>Oliva</h1>
            <p>Disenio e impresión</p>

        </div>
    </div>
    <div id="footer">


        {{-- <p class="textFooter">laravel</p> --}}
    </div>



    <h1>Factura # {{ $factura_id }}</h1>

    <p>Fecha:{{ $fecha }} </p>

    <h2>Cliente</h2>
    <p>Nombre:{{ $cliente['nombre'] }}</p>
    <p>Dirección:{{ $cliente['direccion'] }}</p>


    <h2>Vendedor</h2>
    <p>Nombre: {{ $vendedor['nombre'] }}</p>
    <p>Dirección: {{ $vendedor['direccion'] }}</p>
    <p>Telefono: {{ $vendedor['telefono'] }}</p>


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
        </tbody>
    </table>

    <h2>Resumen</h2>
    {{-- <p>Subtotal: </p> --}}
    <p><b>Total: </b></p>


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
