@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Proveedor</h1>
@stop

@section('content')


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            <h5>Materiales solcitados</h5>
            <br>
            <table class="table table-striped table-bordered" id="demandas">

                <thead>
                    <tr>
                        <th>nombre</th>
                        <th>cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($demanda->detalleDemandas as $item)
                        <tr>
                            <td>{{ $item->material->nombre }}</td>
                            <td>{{ $item->cantidad }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <br><br>
            <a href="{{ route('ofertas.crear', $demanda->id) }}" class="btn btn-success">Aceptar oferta</a>

        </div>
    </div>

@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

@endsection
@section('js')

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var table = new DataTable('#demandas', {
            language: {
                info: 'Mostrar registros de _START_ a _END_ ',
                infoEmpty: 'No hay registros',
                infoFiltered: '(filtrado de _MAX_ registros totales)',
                lengthMenu: 'Mostrar _MENU_ registros',
                zeroRecords: 'No se encontraron coincidencias',
                search: 'Buscar:',
                paginate: {
                previous: 'Anterior',
                next: 'Siguiente',
            },
                emptyTable: 'No hay datos disponibles',
            },


            order: [
                [0, 'desc']
            ],
        });
    </script>
@endsection
