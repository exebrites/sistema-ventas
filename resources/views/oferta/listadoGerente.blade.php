Materiales para hacer un Almaneque <br>
Fecha de cierre "2024-02-12"


<br>
<br>
<table border="1">
    <tr>
        <th>material </th>
        <th>cantidad</th>
    </tr>
    <tr>
        <td>Cartulina Roja</td>
        <td>5 unidades</td>
    </tr>
    <tr>
        <td>Fotos de perro </td>
        <td>5 unidades</td>
    </tr>
    <tr>
        <td>Tijeras</td>
        <td>1 unidades</td>
    </tr>
    <tr>
        <td>Marcadores</td>
        <td>5 unidades</td>
    </tr>
    <tr>
        <td>Regla 30 cm</td>
        <td>2 unidades</td>
    </tr>
</table>
<br>
<br>

Nombre del proveedor: {{ $user[0]->name }} <br>
Correo electronico: {{ $user[0]->email }} <br>



<br>
<br>
<table border="1">
    <tr>
        <th>material </th>
        <th>marca</th>
        <th>cantidad</th>
    </tr>

    @foreach ($oferta as $item)
        <tr>
            <td>{{ $item->material }}</td>
            <td>{{ $item->marca }}</td>

            <td>{{ $item->cantidad }}</td>
        </tr>
    @endforeach
</table>
