<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmación de Entrega</title>
</head>

<body>
    <p>Estimado/a {{ $cliente->nombre }},</p>
    <p>Le informamos que hemos realizado la entrega de su pedido con el número de pedido: {{ $pedido->id }}.</p>
    <p>Muchas gracias por su comprensión.</p>
    <p>Atentamente,</p>
    <p>{{ config('contacto.nombre') }}</p>

</body>

</html>
