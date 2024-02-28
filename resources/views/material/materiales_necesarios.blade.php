@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">

@section('title')

@section('content_header')
    <h1>Materiales necesarios</h1>
@stop

@section('content')
    {{-- {{ dd($producto) }} --}}
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            <div class="card mx-auto" style="width: 18rem;">
                <img src="{{ $detallePedido->producto->image_path }}" class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <p class="card-text">
                        <b>Nombre:</b>{{ $detallePedido->producto->name }} <br>
                        <b>Descripcion:</b> {{ $detallePedido->producto->description }}<br>
                        <b>Alias:</b>{{ $detallePedido->producto->alias }} <br>
                    </p>
                </div>
            </div>
            Para fabricar
            <input type="text" value=" {{ $detallePedido->cantidad }}" readonly>
        </div>
    </div>
    <h2>Seleccionar Cantidades</h2>
    {{-- {{dd($producto->detalleProducto)}} --}}
    {{-- {{dd($materiales)}} --}}
    <div class="card">

        <div class="card-body">
            <form action="{{ route('generar_material') }}" method="post">
                @csrf

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Material</th>

                            <th>Cantidad Necesaria</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detallePedido->producto->detalleProducto as $detalle)
                            <tr>

                                <td>{{ $detalle->materiales->nombre }}</td>

                                <td>

                                    <input type="number" name="cantidades[{{ $detalle->materiales->id }}]"
                                        class="form-control" value="{{ $detalle->cantidad * $detallePedido->cantidad }}"
                                        min="{{ $detalle->cantidad }}" id="{{ $detalle->materiales->id }}">

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="{{ route('productos.show', $detallePedido->producto->id) }}"
                                    class="btn btn-danger btn-ampliado">Cancelar</a>
                            </div>


                            <div>
                                <button type="submit" class="btn btn-primary btn-ampliado">Generar Lista de
                                    Reposición</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    </div>
    {{-- <script>
        function calcular() {
            var inputs = document.querySelectorAll('input[type="number"]');
            var cantProducto = document.getElementById('cantidad').value;
            inputs.forEach(element => {
                element.value = element.value * cantProducto;
            });
            console.log(inputs[1].value);
            console.log(cantProducto);
            inputs[1].value = inputs[1].value * cantProducto;
        }
    </script> --}}
@endsection
