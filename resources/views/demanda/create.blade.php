@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
@section('title')

@section('content_header')
    <h1>Materiales para la compra</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">

            <h2>Lista de Materiales</h2>

            <form action="{{ route('demandas.store') }}" method="post">
                @csrf
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Material</th>
                            <th>Cantidad</th>
                            <th>Seleccionar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reponer as $key => $item)
                            <tr>
                                <td>{{ $item['nombre'] }}</td>
                                <td>{{ $item['cantidad_solicitada'] }}</td>
                                <td><input type="checkbox" id="{{ $key }}" name="materiales[]"
                                        value="{{ $key . '|' . $item['nombre'] . '|' . $item['cantidad_solicitada'] }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                            </div>


                            <div>
                                <button type="submit" class="btn btn-primary btn-ampliado">Enviar Materiales
                                    Seleccionados</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

@stop
