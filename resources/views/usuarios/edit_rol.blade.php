@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Asociar roles a usuario</h1>
@stop

@section('content')
    <div class="card">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            <form method="post" action="{{ route('usuarios.assignMultipleRoles', ['userId' => $user->id]) }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}" class="form-control">
                <div class="form-group">
                    <label for="roles">Selecciona los roles:</label>
                    <select name="roles[]" id="roles" class="form-control js-example-basic-multiple"
                        multiple="multiple">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h2>Remover Roles de Usuario</h2>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <form method="post" action="{{ route('removerRoles', ['userId' => $user->id]) }}">
                @csrf
                <h3>Selecciona los roles para remover del usuario "{{ $user->name }}"</h3>
                <input type="hidden" name="user_id" value="{{ $user->id }}" class="form-control">
                @foreach ($user->roles as $role)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="role_{{ $role->id }}" name="roles[]"
                            value="{{ $role->name }}">
                        <label class="form-check-label" for="role_{{ $role->id }}">
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-danger">Remover Roles</button>
            </form>
        </div>
    </div>
@endsection
@section('css')
    {{-- select 2  --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>

@endsection
