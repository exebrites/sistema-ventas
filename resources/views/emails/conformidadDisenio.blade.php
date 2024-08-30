<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conformidad de diseño</title>
</head>

<body>
    <p>Estimado/a {{ $cliente->nombre }},</p>

    <p>Le enviamos este correo electrónico para informarle que el diseño del producto "{{ $producto->name }}" con el
        número
        de pedido {{ $pedido->id }} ha sido aprobado por nuestro equipo de diseño.</p>

    <p>Al aceptar el diseño, usted acepta que el diseño se ajusta a sus necesidades y especificaciones. Por lo tanto, no
        se
        realizarán cambios adicionales en el diseño a menos que se acuerden previamente con nuestro equipo de diseño.
    </p>

    <p>Si tiene alguna pregunta o inquietud, por favor no dude en comunicarse con nosotros al siguiente correo:
        {{ config('contacto.correo') }}.
    </p>

    <p>Atentamente,</p>
    <p>{{ config('contacto.nombre') }}</p>
</body>

</html>
