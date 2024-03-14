@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Cliente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="">Documento (DNI)</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ $cliente->dni }}" readonly>

            </div>
            <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ $cliente->nombre }}" readonly>

            </div>
            <div class="form-group">
                <label for="">Apellido</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ $cliente->apellido }}" readonly>

            </div>
            <div class="form-group">
                <label for="">Telefono</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ $cliente->telefono }}" readonly>

            </div>
            <div class="form-group">
                <label for="">Correo</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ $cliente->correo }}" readonly>

            </div>
        </div>
    </div>
@stop
