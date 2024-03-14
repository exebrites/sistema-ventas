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
            {{-- Numero de pedido: {{ $comprobante->pedido->id }} <br> --}}
            <div class="form-group">
                <label for="">Numero de pedido</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ $comprobante->pedido->id }} " readonly>
            </div>
            {{-- <div class="form-group">
                <label for="">Numero de comprobatne</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ $comprobante->id }} " readonly>
            </div> --}}
            {{-- <img src="{{ $comprobante->url_comprobantes }}" class="rounded mx-auto d-block" alt="..."> --}}
            <div class="text-center">
                <h2>Comprobante de Pago</h2>
                <img src="{{ $comprobante->url_comprobantes }}" class="rounded mx-auto d-block" alt="Comprobante de Pago">
            </div>

        </div>
    </div>
@endsection
