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
    <h1>Stock</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            <h2>Materiales disponibles</h2>

            <table class="table table-bordered">
                <thead>
                    <tr>

                        <th>Nombre</th>

                        <th>Cantidad en stock</th>
                        <th>orden de compra</th>
                        <th>Diferencia en stock</th>

                        {{-- <th>Reposición</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materialesStock as $id => $material)
                        {{-- <tr class="{{ $dato['reposicion'] ? 'resaltado' : '' }}"> --}}
                        <tr>
                            <td>{{ $material['nombre'] }}</td>

                            <td>{{ $material['stockActual'] }}</td>
                            <td>{{ $material['stockSolicitado'] }}</td>
                            <td>{{ -$material['diferenciaStock'] }}</td>

                            {{-- <td>{{ $material['reposicion'] ? 'Sí' : 'No' }}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            {{-- <a href="{{ route('demandas.create', $datos) }}">Generar orden de compra</a> --}}


            <div class="container ">
                <div class="row">
                    <div class="col d-flex">
                        {{-- 
                        <div id="btn-cancelar">
                            <a href="{{ route('productos.index') }}" class="btn btn-danger btn-ampliado">Cancelar</a>
                        </div>


                        <div>
                            <a class="btn btn-primary btn-ampliado"
                                href="{{ route('demandas.create') }}?{{ http_build_query($datos) }}">Generar orden de
                                compra</a>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
