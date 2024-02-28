@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Detalle rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            <h2>Detalles del Rol: {{ $role->name }}</h2>
            <br>
            <p><strong>Nombre del Rol:</strong> {{ $role->name }}</p>
            <br>
            <h4 class="card-title">Permisos Asociados</h4>
            <br>
            @if ($role->permissions->count() > 0)
                <ul>
                    @foreach ($role->permissions as $permission)
                        <li>{{ $permission->name }}</li>
                    @endforeach
                </ul>
            @else
                <p>El rol no tiene permisos asociados.</p>
            @endif
        </div>
    </div>
@endsection
