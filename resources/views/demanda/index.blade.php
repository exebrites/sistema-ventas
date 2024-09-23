@extends('adminlte::page')
@section('title')
@section('content_header')
    <h1>Orden de compra</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-striped table-bordered" id="demandas">
                <thead>
                    <tr>
                        <th>Numero de Orden</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de cierre</th>
                        <th>Estado</th>
                        <th>Ver ofertas</th>
                        @role(['admin', 'empresa'])
                            <th>Acciones</th>
                        @endrole

                    </tr>
                </thead>
                <tbody>
                    <?php $estados = ['en-confirmacion' => 'En confirmacion', 'confirmado' => 'Confirmado', 'rechazado' => 'Rechazado']; ?>
                    @foreach ($demandas as $demanda)
                        <?php
                        $estado = array_key_exists($demanda->estado, $estados) ? $estados[$demanda->estado] : $demanda->estado;
                        ?>
                        <tr>
                            <td>{{ $demanda->id }}</td>
                            <td>{{ $demanda->created_at->format('d-m-Y') }}</td>
                            <td>{{ $demanda->fecha_cierre->format('d-m-Y') }}</td>
                            <td>{{ $estado }}</td>
                            @role(['admin', 'empresa'])
                                <td width="10px"><a class="btn btn-warning btn btn-sm btn-fixed-width"
                                        href="{{ route('demandas.edit', $demanda->id) }}">Editar</a></td>
                                <td width="10px"><a class="btn btn-primary btn btn-sm btn-fixed-width"
                                        href="{{ route('demandas.show', $demanda->id) }}">Ver</a></td>
                            @endrole

                            @role(['proveedor'])
                                <td width="10px">
                                    @if ($demanda->fechaCierre())
                                        <a class="btn btn-primary btn btn-sm btn-fixed-width"
                                            href="{{ route('demandas.showProveedor', $demanda->id) }}">Ver</a>
                                    @endif
                                </td>
                            @endrole
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('css')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('css/btnFijo.css') }}">
    {{-- btn-fixed-width --}}
    {{-- DATATABLE --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css">


@endsection
@section('js')
    {{-- 
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var table = new DataTable('#demandas', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
            order: [
                [0, 'desc']
            ],
        });
    </script> --}}

    {{-- DATATABLE --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#demandas', {
            language: {
                info: 'Mostrar registros de _START_ a _END_ ',
                infoEmpty: 'No hay registros',
                infoFiltered: '(filtered from _MAX_ total records)',
                lengthMenu: 'Mostrar _MENU_ registros',
                zeroRecords: 'No se encontraron coincidencias',
                search: 'Buscar:',

                emptyTable: 'No hay datos disponibles',
            }
        });
    </script>

@endsection
