<!DOCTYPE html>
<html>

<head>
    <title>Diseño Realizado</title>
</head>

<body>
    <p>Hola! {{ $cliente->nombre }}</p>
    <p>El diseño de tu producto {{ $producto->name }} con el numero de pedido {{ $pedido->id }} está hecho.</p>
    <p>Por favor, ingresa a la sección de pedidos para realizar la revisión del diseño. Muchas gracias.</p>

    <p>Nombre de la empresa{{ $empresa }}</p>
</body>

</html>
