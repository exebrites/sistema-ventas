<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <div class="card">

        <div class="card-body">


            <H1 style="align-content:center">Tu pedido </H1>

            <h5>
                <br>
                Número de pedido : {{ $id }}
                <br>
                Costo total: {{ $total }}
                <br>
                Costo abonar: {{ $total * 0.5 }}

            </h5>

            <p> Se le recuerda que se debe abonar el 50% del costo total para poder comenzar con el pedido
                <br>
                <br>

                CVU: {{ config('contacto.cvu') }}
                <br>
                Alias :{{ config('contacto.alias') }}
                <br>
                <br>
                Una vez realizada la transferencia bancaria subí tú comprobante para luego ser
                aprobado el pago

                En caso de ya haber efectuado el pago y no verlo reflejado en el sistema escribinos a olivas@gmail.com
                <br>
                <br>
                Podes realizar el pago a traves de mercado pago : <a href="https://www.mercadopago.com.ar/home">Mercado
                    pago </a>
                <br>
                Recorda: Descargá tu comprobante y subirlo al sistema luego de haber realizado el pago
                <br><br>
                {{-- Siguiente pago: <a href="{{ route('checkout.index') }}">subir comprobate</a> --}}
                Saludos desde {{ config('contacto.nombre') }}
            </p>
        </div>
    </div>
</body>

</html>
