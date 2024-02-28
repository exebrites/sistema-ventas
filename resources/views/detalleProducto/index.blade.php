{{-- {{ $producto }}
<div class="container mt-4">
    <h2>Ejemplo de Tabla Bootstrap</h2>
    <form action="{{ route('detalleProducto.store') }}" method="post">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materiales as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td><input type="checkbox" name="materiales:[]" value="{{ $item }}"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit">Enviar</button>
    </form>
</div> --}}
