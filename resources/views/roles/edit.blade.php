@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Editar Rol</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
            <a href="{{ route('editRol', $role->id) }}" class="btn btn-success">Asociar permisos a rol</a>

        </div>
        {{-- <h1> editar rol</h1> --}}
        <div class="card-body">
            <form action="{{ route('roles.update', $role) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="">Nombre del rol</label>
                    <input type="text" name="name" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $role->name }}">
                    {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                </div>


                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="" class="btn btn-danger btn-ampliado">Cancelar</a>
                            </div>


                            <div>
                                <button type="submit" class="btn btn-success btn-ampliado">Actualizar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
@endsection
