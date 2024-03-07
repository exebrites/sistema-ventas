@extends('adminlte::page')
@section('title')
@section('content_header')
    <h1>Clientes</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('clientes.create') }}" class="btn btn-success">Agregar nuevo cliente</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered" id="clientes">
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Apellido </th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $item)
                        <tr>
                            <td> {{ $item->dni }} </td>
                            <td> {{ $item->nombre }}</td>
                            <td> {{ $item->apellido }} </td>
                            <td> {{ $item->telefono }}</td>
                            <td> {{ $item->correo }} </td>
                            <td width="10px"><a href="{{ route('clientes.edit', $item->id) }}"
                                    class="btn btn-warning btn btn-sm btn-fixed-width">Editar</a></td>
                            <td width="10px">
                                <form action="{{ route('clientes.destroy', $item->id) }}" method="post"
                                    class="formulario-eliminar">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn btn-sm btn-fixed-width" type="submit">Borrar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/btnFijo.css') }}">
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
        var table = new DataTable('#clientes', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
            // order: [
            //     [0, 'desc']
            // ],
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    {{-- implementacion de una confirmacion de borrado por el usuario --}}
    {{-- Dentro del from de eliminar agregar - >  class="formulario-eliminar" --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/confirmacionBorrado.js') }}"></script>
@endsection
