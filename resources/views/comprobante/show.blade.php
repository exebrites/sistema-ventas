@extends('adminlte::page')

@section('title')

@section('content_header')
<h1>Comprobante</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            Numero de pedido: {{ $comprobante->pedido->id }} <br>
            Numero de comprobante: {{ $comprobante->id }} <br>
            Imagen del comprobante: <br>
            <img src="{{ $comprobante->url_comprobantes }}" class="img-fluid" alt="">

        </div>
    </div>
@endsection
