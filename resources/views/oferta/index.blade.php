Lista la demando
<br>


Materiales para hacer un Almaneque <br>
Fecha de cierre "2024-02-12"

<br>
<br>
<h2>Tabla de Materiales</h2>

<table border="1">
    <thead>
        <tr>
            <th>Nro de demandas/compra</th>
            <th>Nombre</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($demandas as $material)
            <tr>
                <td>1</td>
                <td>{{ $material['nombre'] }}</td>
                <td>{{ $material['cantidad'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<br>
<br>
<table border="1">
    <tr>
        <th>material </th>
        <th>marca</th>
        <th>cantidad</th>
    </tr>

    @foreach ($ofertas as $item)
        <tr>
            <td>{{ $item->material }}</td>
            <td>{{ $item->marca }}</td>

            <td>{{ $item->cantidad }}</td>
        </tr>
    @endforeach
</table>

{{-- {{ dd($ofertas) }} --}}
<br>
<br>
<form action="{{ route('ofertas.store') }}" method="post">
    @csrf

    <div class="mb-3">
        <label>Material</label>
        <input type="text" class="form-control" id="" name="material">
    </div>

    <div class="mb-3">
        <label>Marca</label>
        <input type="text" class="form-control" id="" name="marca">
    </div>
    <div class="mb-3">
        <label>Cantidad</label>
        <input type="text" class="form-control" id="" name="cantidad">
    </div>

    <button type="submit">Realizar oferta</button>
</form>
<br>
{{-- <a href="{{ back() }}">Cancelar  oferta</a> --}}

<br>
<a href="{{ route('finalizar_oferta') }}">finalizar oferta</a>
