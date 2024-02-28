@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Detalle permiso</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">

            <div class="form-group">
                <label for="">Nombre del rol</label>
                <input type="text" name="name" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ $permiso->name }}" readonly>
            </div>

        </div>
    </div>
@endsection
