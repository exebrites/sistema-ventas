@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Permisos</h1>
@stop

@section('content')
    <div class="card">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-header">
            {{-- Agregar --}}
            <a href="{{ route('permisos.create') }}" class="btn btn-success">Agregar nuevo permiso</a>


        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered" id="permisos">
                <thead>
                    <tr>
                        <th>Nombre del permiso</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permisos as $permiso)
                        <tr>
                            <td>{{ $permiso->name }}</td>
                            <td width="10px"><a class="btn btn-warning btn btn-sm"
                                    href="{{ route('permisos.edit', $permiso->id) }}">Editar</a></td>
                            <td width="10px">
                                <form action="{{ route('permisos.destroy', $permiso->id) }}" method="post"
                                    class="formulario-eliminar">
                                    @csrf
                                    @method('delete')
                                    <button id="tuBotonId" class="btn btn-danger btn btn-sm " type="submit">borrar</button>
                                </form>
                            </td>
                            <td width="10px"><a class="btn btn-secondary btn btn-sm"
                                    href="{{ route('permisos.show', $permiso->id) }}">ver</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

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
        var table = new DataTable('#permisos', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    </script>
@endsection
