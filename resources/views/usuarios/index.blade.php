@extends('adminlte::page')
@section('title')
@section('content_header')
    <h1>Usuarios</h1>
@stop
@section('content')
    <div class="card">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-body">
            <a class="btn btn-success" href="{{ route('usuarios.create') }}">Agregar usuario</a>
            <br>
            <br>
            <table class="table table-striped table-bordered" id="usuarios">
                <thead>
                    <tr>
                        <th>Identificador</th>
                        <th>Nombre</th>
                        <th>Correo electronico</th>
                        <th>Tipo de Usuario</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->tipo_usuario }}</td>
                            <td width="10px"><a class="btn btn-warning btn btn-sm"
                                    href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a></td>
                            <td width="10px">
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="post"
                                    class="formulario-eliminar">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn btn-sm " type="submit">Borrar</button>
                                </form>
                            </td>
                            <td width="10px"><a class="btn btn-secondary btn btn-sm"
                                    href="{{ route('usuarios.show', $usuario->id) }}">Ver</a></td>
                            <td> <a href="{{ route('usuarios.showAssignMultipleRolesForm', $usuario->id) }}"
                                    class="btn btn-success">Asociar roles</a>
                            </td>
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
        var table = new DataTable('#usuarios', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
            order: [
                [0, 'desc']
            ],
        });
    </script>
    {{-- implementacion de una confirmacion de borrado por el usuario --}}

    {{-- Dentro del from de eliminar agregar - >  class="formulario-eliminar" --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/confirmacionBorrado.js') }}"></script>
@endsection
