@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Confirmacion de oferta</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">

            @switch($oferta->estado)
                @case('aceptada')
                    <h3>Oferta Aceptada</h3>
                @break

                @case('pendiente')
                    <h3 style=" background-color: yellow;">Oferta en espera</h3>
                @break

                @case('cancelada')
                    <h3 style=" background-color: red;">Oferta Rechazada</h3>
                @break

                @default
            @endswitch
            <hr>
            <div class="form-group">
                <label for="">Numero de oferta</label>
                <input type="text" class="form-control" value="{{ $oferta->id }}" readonly>

            </div>
            <div class="form-group">
                <label for="">Fecha de entrega</label>
                <input type="text" class="form-control" value="{{ $oferta->fecha_entrega }}" readonly>
            </div>
            <div class="form-group">
                <label for="">Estado</label>
                <input type="text" class="form-control" value="{{ $oferta->estado }}" readonly>
            </div>
            <hr>
            <table class="table table-striped table-bordered" id="ofertas">
                <thead>
                    <tr>
                        <th>Nombre del material</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Subtotal</th>

                    </tr>
                </thead>
                <tbody>
                    {{-- Mostrar información para comparar la oferta y la demanda --}}
                    {{-- Mostrar el precio unitario, el precio subtotal y el precio total de oferta --}}
                    @php
                        $totalOferta = 0; // Inicializar el total de la oferta
                    @endphp

                    @foreach ($oferta->detalleOferta as $detalle)
                        <tr>
                            <td>{{ $detalle->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>{{ $detalle->precio }}</td>
                            <td>{{ $detalle->precio * $detalle->cantidad }}</td>
                        </tr>

                        @php
                            $totalOferta += $detalle->precio * $detalle->cantidad; // Sumar al total de la oferta
                        @endphp
                    @endforeach

                    {{-- Mostrar el total de la oferta --}}

                </tbody>
                <tfoot>
                    {{-- Mostrar el total de la oferta en el pie de la tabla --}}
                    <tr>
                        <td colspan="3" style="text-align: right;">Total</td>
                        <td>{{ $totalOferta }}</td>
                    </tr>
                </tfoot>
            </table>
            <hr>
            <br>
            <br>
            {{-- ocultar btn confirmar oferta una vez confirmada --}}
            @if ($oferta->estado == 'pendiente')
                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="" class="btn btn-danger btn-ampliado">Cancelar</a>
                            </div>


                            <div>

                                <a href="{{ route('confirmarOferta', $oferta->id) }}"
                                    class="btn btn-primary btn-ampliado">Confirmar Oferta</a>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('css')


    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">

    <style>
        h3 {
            background-color: #27d561;
            /* Cambia el color de fondo del texto a blanco */
            padding: 10px;
            /* Agrega un poco de espacio alrededor del texto */
            border-radius: 8px;
            /* Agrega esquinas redondeadas al contenedor del texto */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Agrega una sombra sutil */
        }
    </style>
@endsection



@section('js')

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        var table = new DataTable('#ofertas', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    </script>
@endsection
