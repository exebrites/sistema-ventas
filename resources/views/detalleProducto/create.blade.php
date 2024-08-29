@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Agregar materiales a producto </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            {{-- producto --}}

            <div class="mb-3">
                <label for="" class="form-label">Nombre del producto </label>
                <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId"
                    value="{{ $producto->name }}" readonly />
                {{-- <small id="helpId" class="text-muted">Help text</small> --}}
            </div>

            <hr>
            {{-- filtro --}}
            <b>Filtros</b>

            <div class="mb-3">
                <label for="" class="form-label">Nombre de material</label>

                <input type="text" onkeyup="filtroMateriales(event);" id="" class="form-control">
                {{-- <small id="helpId" class="text-muted">Help text</small> --}}
            </div>

            <hr>

            <form action="{{ route('detalleproducto.store') }}" method="post" class="needs-validation"
                onsubmit="validacion(event);">
                @csrf
                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Material</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materiales as $material)
                            <tr>
                                <td>{{ $material->nombre }}</td>
                                <td>
                                    <input type="number" name="materiales[{{ $material->id }}]" id=""
                                        class="form-control" required min="1" value="1" required
                                        pattern="[0-9]+">
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" value="{{ $material->id }}" class="form-check-input"
                                            id="material-{{ $material->id }}" name="check[{{ $material->id }}]">
                                        <label class="form-check-label"
                                            for="material-{{ $material->id }}">Seleccionar</label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
@stop
@section('js')
    <script>
        function filtroMateriales(event) {

            // objetivo : 
            // mostrar solo los materiales que coincidan con el filtro

            // 1. obtener el valor del input 

            input = event.target.value.toUpperCase();
            if (input == "") {
                for (let i = 0; i < tabla.length; i++) {

                    // console.log(td);
                    // 3.1 buscar si input esta contenido dentro de td
                    tabla[i].style.display = 'none';


                }
            }
            console.log(input);
            // 2. los renglones de la tabla tr
            tabla = document.querySelectorAll('tbody tr');
            // console.log(tabla);

            // 3. comparar los materiales con el valor ingresado 
            for (let i = 0; i < tabla.length; i++) {

                td = tabla[i].getElementsByTagName('td')[0].innerText;
                // console.log(td);
                // 3.1 buscar si input esta contenido dentro de td
                td.includes(input) ? tabla[i].style.display = '' : tabla[i].style.display = 'none';


            }

            // 4. mostrar los renglones que coincidan
            // event.target.value= ""
        }
    </script>


@endsection
