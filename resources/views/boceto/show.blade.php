@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Detalle del Boceto </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>

                            <th>Negocio</th>
                            <th>Objetivo</th>
                            <th>Publico</th>
                            <th>Contenido</th>
                            <th>Ir a disenio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td>{{ $boceto->negocio }}</td>
                            <td>{{ $boceto->objetivo }}</td>
                            <td>{{ $boceto->publico }}</td>
                            <td>{{ $boceto->contenido }}</td>
                            <td> <a href="{{ route('disenios.show', $boceto->detallePedido->disenio->id) }}">Ver diseño</a>
                            </td>



                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-6">
                        logo de la empresa


                        <img src="{{ $boceto->url_logo }}" class="img-fluid" alt="Logo">
                        <form action="{{ route('descargar_boceto') }}" method="post">
                            @csrf
                            <input type="hidden" name="archivo" value="url_logo">
                            <input type="hidden" name="id" value={{ $boceto->id }}>
                            <br>
                            <button type="submit" class="btn btn-primary">Descargar</button>
                        </form>


                    </div>

                    <div class="col-6">
                        imagen de lo que quiere que se muestre
                        <img src="{{ $boceto->url_img }}" class="img-fluid" alt="Imagen">
                        <form action="{{ route('descargar_boceto') }}" method="post">
                            @csrf
                            <input type="hidden" name="archivo" value="url_img">
                            <input type="hidden" name="id" value={{ $boceto->id }}>
                            <br>
                            <button type="submit" class="btn btn-primary">Descargar</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
