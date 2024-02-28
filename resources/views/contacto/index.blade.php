@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Informacion de la empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            Correo electronico : {{ $contacto['correo'] }} <br>
            Telefono: {{ $contacto['telefono'] }} <br>
            Direccion :{{ $contacto['direccion'] }} <br>

            <a class="btn btn-warning" href="{{route('contacto.edit',1)}}">Editar </a>
        </div>
    </div>
@endsection
