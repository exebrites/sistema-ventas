@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>prueba </h1>
@stop

@section('content')
    {{-- {{dd($p)}} --}}

    <img src="{{ $p->image_path }}" alt="" srcset="">
@endsection
