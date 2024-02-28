<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <h1>Tabla de Datos</h1>

            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cantidad Solicitada</th>
                        <th>Cantidad Disponible</th>
                        <th>Reposición</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materiales_reposicion as $id => $dato)
                        <tr class="{{ $dato['reposicion'] ? 'resaltado' : '' }}">
                            <td>{{ $id }}</td>
                            <td>{{ $dato['nombre'] }}</td>
                            <td>{{ $dato['cantidad_solicitada'] }}</td>
                            <td>{{ $dato['Cantidad_disponible'] }}</td>
                            <td>{{ $dato['reposicion'] ? 'Sí' : 'No' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
