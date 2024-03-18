@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Entrega</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            @if ($entrega->local)
                {{-- {{ 'Se retira en local ' }} --}}
                <h3 style=" background-color: yellow;">Retira en local</h3>
            @else
                <div class="form-group">
                    <label for="">Direccion</label>
                    <input type="text" name="" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $entrega->direccion }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Telefono</label>
                    <input type="text" name="" id="" class="form-control" placeholder=""
                        aria-describedby="helpId"value="{{ $entrega->telefono }}" readonly>

                </div>
                <div class="form-group">
                    <label for="">Recepcion</label>
                    <input type="text" name="" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $entrega->recepcion }}" readonly>

                </div>
                <div class="form-group">
                    <label for="">Nota</label>
                    <input type="text" name="" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $entrega->nota }}" readonly>

                </div>
            @endif
        </div>
    </div>
@endsection
@section('css')
    <style>
        h3 {
            background-color: #27d561;
            /* Cambia el color de fondo del texto a blanco */
            padding: 10px;
            /* Agrega un poco de espacio alrededor del texto */
            border-radius: 8px;
            /* Agrega esquinas redondeadas al contenedor del texto */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Agrega una sombra sutil */
        }
    </style>
@endsection
