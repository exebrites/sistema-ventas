@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Editar permiso</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>

        <div class="card-body">
            <form action="{{ route('permisos.update', $permiso) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="">Nombre del rol</label>
                    <input type="text" name="name" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $permiso->name }}">
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
