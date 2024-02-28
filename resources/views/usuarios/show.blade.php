@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Detalle usuario</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">

            <h2>Detalles del usuario: {{ $usuario->name }}</h2>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Información del usuario</h4>
                    <p><strong>Nombre del usuario:</strong> {{ $usuario->name }}</p>

                    <h4 class="card-title">Roles Asociados</h4>
                    @if ($usuario->permissions->count() > 0)
                        <ul>
                            @foreach ($role->permissions as $permission)
                                <li>{{ $permission->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>El usuario no tiene roles asociados.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
