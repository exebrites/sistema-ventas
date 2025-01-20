@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Informacion de la empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="mb-3">
                <label for="" class="form-label">Correo electronico:</label>
                <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId"
                    readonly value="{{ $contacto['correo'] }}" />

            </div>

            <div class="mb-3">
                <label for="" class="form-label">Telefono:</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" readonly value="{{ $contacto['telefono'] }}" />

            </div>

            <div class="mb-3">
                <label for="" class="form-label">Direccion:</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" readonly value="{{ $contacto['direccion'] }}" />

            </div>

            <img
                src="{{$contacto['imagen']}}"
                class="img-fluid rounded-top"
                alt="Logo de la empresa"
            />
            
            <a class="btn btn-warning" href="{{ route('contacto.edit', 1) }}">Editar </a>
        </div>
    </div>
@endsection
