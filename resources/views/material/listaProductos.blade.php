Listar todos los materiales para seleccionar uno
enviar a materiales_necesarios

<form action="{{route('materiales_necesarios')}}" method="get">
    <div class="container mt-4">
        <h2></h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>id</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                      
                        <td>usuario1@example.com</td>
                        <td><input type="checkbox" name="producto_id" value="{{ $item->id }}"></td>
                    </tr>
                @endforeach
              

            </tbody>
        </table>
    </div>
    <button type="submit">Enviar</button>
</form>
