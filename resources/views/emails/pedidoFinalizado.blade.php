<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedido Finalizado</title>
</head>

<body>
    <h1>Hola {{ $cliente->nombre }},</h1>
    <p>Le informamos que su pedido con el nro de pedido: {{ $pedido->id }} ha sido finalizado.</p>
    <p>A continuacion, se detallan los productos pedidos:</p>
    <ul>
        {{-- {{dd($pedido->entrega)}} --}}
        @foreach ($pedido->detallePedido as $detalle)
            <li>
                {{ $detalle->producto->name }} - {{ $detalle->cantidad }} unidades - {{ $detalle->subtotal }}
                {{-- @if ($detalle->boceto)
                    - con boceto: {{ $detalle->boceto->ruta }}
                @endif --}}
                @if ($detalle->disenio)
                    - con diseño: {{ $detalle->disenio->disenio_estado ? 'SI' : 'NO' }}
                    {{-- @elseif ($detalle->boceto)
                    - con boceto: {{ $detalle->boceto->ruta }} --}}
                @else
                    - Sin disenio
                @endif
            </li>
        @endforeach
    </ul>
    <p>Precio total pagado: {{ $pedido->costo_total }}</p>
    <p>Lugar de entrega: @if ($pedido->entrega[0]->local)
            {{ 'Retirar en local' }}
        @else
            {{ 'Envio a domicilio' }}
            {{ $pedido->entrega[0]->direccion }}, <br>telefono: {{ $pedido->entrega[0]->telefono }},<br> recepcion:
            {{ $pedido->entrega[0]->recepcion }}, <br> nota: {{ $pedido->entrega[0]->nota }}
            <br>
        @endif
    </p>
    <p>Saludos cordiales,</p><br>
    <p>{{ config('contacto.nombre') }}</p>
</body>

</html>
