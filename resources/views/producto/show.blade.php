@extends('adminlte::page')
@section('title')
@section('content_header')
    <h1>Detalle producto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
            <a href="{{ route('detalleproducto.show', $producto->id) }}">Fabricacion producto</a>
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
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var table = new DataTable('#materiales', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
@endsection
