@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Asociar permisos a un rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>

        <div class="card-body">
            <h2>Asociar Permisos a Rol</h2>

            <form method="post" action="{{ route('updateRol', $role->id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="rol_id" id="name" value="{{ $role->id }}" class="form-control">
                <div class="form-group">
                    <label for="name">Nombre del Rol:</label>
                    <input type="text" name="name" id="name" value="{{ $role->name }}" class="form-control"
                        readonly>
                </div>

                <div class="form-group">
                    <label for="permissions">Permisos:</label>
                    <select name="permissions[]" id="permissions" class="form-control  js-example-basic-multiple"
                        multiple="multiple">
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->name }}"
                                {{ $role->hasPermissionTo($permission->name) ? 'selected' : '' }}>
                                {{ $permission->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                {{-- <select class="form-control js-example-basic-multiple" name="proveedores[]" id="" multiple="multiple">
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre_contacto }}</option>
                @endforeach
            </select> --}}

                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h2>Remover Permisos de Rol</h2>

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form method="post" action="{{ route('remover', ['roleId' => $role->id]) }}">
                @csrf

                <h3>Selecciona los permisos para remover del rol "{{ $role->name }}"</h3>

                @foreach ($role->permissions as $permission)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="permission_{{ $permission->id }}"
                            name="permissions[]" value="{{ $permission->name }}">
                        <label class="form-check-label" for="permission_{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-danger">Remover Permisos</button>
            </form>
        </div>
    </div>

@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('js')

    {{-- select 2  --}}

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>



@endsection
