@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Detalle pedido</h1>
@stop

@section('content')
    {{-- {{ $detalle->pedidos }} <br> --}}
    {{ $detalle }} <br>
    {{-- {{ $detalle->producto }} <br> --}}
@stop
