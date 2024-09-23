@extends('adminlte::page')
<style>
    .resaltado {
        background-color: #FFC0C0;
        /* Cambia este color según tus preferencias */
    }
</style>

<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">

@section('title')

@section('content_header')
    <h1>Lista de materiales necesarios </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered" id="materiales">
                <thead>
                    <tr>
                        <th>Material</th>
                        <th>Cantidad</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materialesNecesarios as $material)
                        <tr style="background-color: {{ $material['stock'] < $material['cantidad'] ? '#FF0000' : '#008000' }}">
                            <td>{{ $material['nombre'] }}</td>
                            <td>{{ $material['cantidad']}}</td>
                            <td>{{ $material['stock']}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
