<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmacion de Imprenta</title>
</head>

<body>
    <h1>Confirmacion de Imprenta</h1>
    <p>Estimado/a {{ $cliente->nombre }},</p>
    <p>Le informamos que su pedido con el nro de pedido: {{ $pedido->id }} ya se encuentra en el proceso de
        confirmacion de imprenta.</p>
    <p>Le pedimos que ingrese a su perfil y revise el pedido para confirmar la informacion.</p>
    {{-- <p>Si nota algun error, por favor comuniquese con nosotros lo antes posible.</p> --}}
    <p>Muchas gracias por su comprension.</p>
    <p>Atentamente,</p>
    <p>{{ config('contacto.nombre') }}</p>
</body>

</html>
