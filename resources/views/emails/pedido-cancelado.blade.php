<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Cancelado</title>
</head>
<body>
    <h1>Hola,</h1>
    <p>Lamentamos informarte que tu pedido con ID: {{ $pedido->id }} ha sido cancelado.</p> 
    <p><strong>Motivo de la cancelación:</strong> {{ $motivo }}</p>
    <p>Si tienes alguna pregunta, por favor contáctanos.</p>
     <p>Saludos,<br>{{ config('contacto.nombre') }}</p> 
     <p>Comunicate al {{ config('contacto.correo') }}</p>
</body>
</html>
