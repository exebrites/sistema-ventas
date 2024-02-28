@extends('adminlte::page')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

@section('title')

@section('content_header')
    <h1> Diseños</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{ route('disenios.create') }}">Agregar nuevo diseño</a>
            <table class="table table-striped" id="disenios">
                <thead>
                    <tr>
                        <th>Nro de pedido</th>
                        <th>Nro de detalle</th>
                        <th>Producto</th>
                        <th>Estado de diseño</th>
                        <th>Revision</th>
                        {{-- <th>Imagen de diseño</th> --}}
                        <th></th>

                    </tr>

                </thead>
                <tbody>


                    @foreach ($pedidos as $pedido)
                        @foreach ($pedido->detallePedido as $detalle)
                            {{-- {{ dd($detalle->producto->name) }} --}}
                            <tr>
                                <td> {{ $pedido->id }}</td>
                                <td> {{ $detalle->id }}</td>
                                <td> {{ $detalle->producto->name }}</td>
                                <td>{{ $detalle->disenio->disenio_estado ? 'Tiene' : 'No tiene' }}</td>
                                <td>{{ $detalle->disenio->revision ? 'Si' : 'NO' }}</td>
                                {{-- <td>{{ $detalle->disenio->url_imagen }}</td> --}}
                                <td><a href="{{ route('disenios.show', $detalle->disenio->id) }}">ver mas</a></td>
                            </tr>
                        @endforeach
                    @endforeach
                    {{-- @foreach ($pedidos as $pedido)
                        @foreach ($pedido->detallePedido as $detalle)
                            {{ dd($detalle->disenio->url_imagen) }}
                        @endforeach
                    @endforeach --}}

                </tbody>
            </table>

        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var table = new DataTable('#disenios', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>


@stop
