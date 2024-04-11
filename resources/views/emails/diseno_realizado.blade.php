<!DOCTYPE html>
<html>

<head>
    <title>Diseño Realizado</title>
</head>

<body>
    <p>Hola! {{ $cliente->nombre }}</p>
    <p>El diseño de tu producto "{{ $producto->name }}" con el numero de pedido {{ $pedido->id }} está hecho.</p>
    <p>Por favor, ingresa a la sección de pedidos (enlace <a href="http://127.0.0.1:8000/pedidoCliente">Tus pedidos </a>)
        para realizar la revisión del diseño. Muchas gracias.</p>
    <p></p>
    <p>Saludos desde {{ $empresa }}</p>
</body>

</html>
