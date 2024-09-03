<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmacion de orden de compra</title>
</head>

<body>
    <p>Estimado/a {{ $proveedor->nombre_empresa }},</p>
    <p>Le enviamos esta comunicacion para informarle que ha sido seleccionado para proveer los siguientes productos:</p>
    <ul>
        @foreach ($demanda->detalleDemandas as $detalle)
            <li>
                {{-- {{ dump($detalle) }} --}}
                Material {{ $detalle->material->nombre }} -  {{ $detalle->cantidad }} unidades
            </li>
        @endforeach
    </ul>
    <p>Por favor, indiquenos si es capaz de cumplir con esta orden de compra. Si es asi, por favor indiquenos el plazo
        de entrega.</p>
    <p>Atentamente,</p>
    <p>{{ config('contacto.nombre') }}</p>

</body>

</html>
