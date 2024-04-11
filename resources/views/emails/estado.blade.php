<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{-- Para metrizar estado,cliente,pedido --}}
    <h1>Estado de tu pedido</h1>

    se notifica a {{ $cliente }} con el Nro de pedido: {{ $nroPedido }} , que su pedido esta en un estado de
    {{ $estado }}.
    {{-- Esto significa que se estan creando los diseños para los productos solictados en el pedido xxxx --}}

    <h5>Se solicita al cliente que ingrese a tus pedidos (enlace <a href="http://127.0.0.1:8000/pedidoCliente">Tus pedidos </a>) al pedido Nro {{ $nroPedido }} y haga la revision de propuesta de
        diseño</h5>

    para asi poder seguir con las siguientes etapas del proceso. Muchas gracias y que tenga buen dia <br>

    Saludos desde {{ config('contacto.nombre') }}
</body>

</html>
