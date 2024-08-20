@extends('adminlte::page')
@section('title')
@section('content_header')
    <h1>Detalle producto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
            <a href="{{ route('detalleproducto.show', $producto->id) }}" class="btn btn-primary">Fabricacion producto</a>
        </div>
        <div class="card-body">

            <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" class="form-control" value="{{ $producto->name }}" readonly>
            </div>

            <div class="form-group">
                <label for="">Alias</label>
                <input type="text" class="form-control" value="{{ $producto->alias }}" readonly>

            </div>

            <div class="form-group">
                <label for="">Descripción</label>
                <input type="text" class="form-control" value="{{ $producto->description }}" readonly>
            </div>

            <div claass="form-group">
                <label for="">Precio de venta</label>
                <input type="text" class="form-control" value="$ {{ $producto->price }}" readonly>
            </div>
            <hr>

            <div class="container text-center">
                <h2>Imagen del producto</h2>
                <p>{{ $producto->name }}</p>
                <img src="{{ $producto->image_path }}" alt="Descripción de la imagen" class="img-fluid">
            </div>

        </div>
    </div>

@stop
