El proveedor : {{ $user->name }} realizó las siguientes ofertas <br>
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
