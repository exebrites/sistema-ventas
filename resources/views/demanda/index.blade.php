@extends('adminlte::page')
@section('title')
@section('content_header')
    <h1>Demandas</h1>
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
                        <th>Numero de demanda</th>
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
                    @foreach ($demandas as $demanda)
                        <tr>
                            <td>{{ $demanda->id }}</td>
                            <td>{{ $demanda->created_at->format('d-m-Y') }}</td>
                            <td>{{ $demanda->fecha_cierre->format('d-m-Y') }}</td>
                            <td>{{ $demanda->estado }}</td>
                            @role(['admin', 'empresa'])
                                <td width="10px"><a class="btn btn-primary btn btn-sm"
                                        href="{{ route('demandas.show', $demanda->id) }}">Ver</a></td>
                                <td width="10px"><a class="btn btn-warning btn btn-sm"
                                        href="{{ route('demandas.edit', $demanda->id) }}">Editar</a></td>
                            @endrole
                            {{-- @role(['admin', 'proveedor']) --}}
                            @role(['proveedor'])
                                <td width="10px"><a class="btn btn-primary btn btn-sm"
                                        href="{{ route('demandas.showProveedor', $demanda->id) }}">Ver</a></td>
                                {{-- <td></td>
                                <td></td> --}}
                            @endrole
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
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
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
            order: [
                [0, 'desc']
            ],
        });
    </script>
@endsection
