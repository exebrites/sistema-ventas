@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
@section('title')

@section('content_header')
    <h1>Actualizar stock de materiales</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <h3>Nombre del material : {{ $material->nombre }}</h3><br>
            <form action="{{ route('materiales.stock_update', $material->id) }}" method="post">
                @csrf
                @method('put')
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <div>
                                <label for="">Cantidad de stock: </label>
                                <input type="text" readonly value="{{ $material->stock }}" class="form-control ">
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <label for="">Fecha de adquisicion: </label>
                                <input type="text" readonly value="{{ $material->fecha_adquisicion }}"
                                    class="form-control ">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <div>
                                <label for="cantidadStock">Cantidad de Stock:</label>
                                <input type="number" class="form-control" id="cantidadStock" name="cantidadStock" required
                                    value="{{ $material->stock }}">
                            </div>

                        </div>
                        <div class="col">
                            <div>
                                <label for="fechaReposicion">Fecha de Reposición:</label>
                                <input type="date" class="form-control" id="fechaReposicion" name="fechaReposicion"
                                    required>
                            </div>
                        </div>

                    </div>
                    <input type="hidden" name="material_id" value="{{ $material->id }}">
                </div>

<br><br>
                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="" class="btn btn-danger btn-ampliado">Cancelar</a>
                            </div>


                            <div>
                                <button type="submit" class="btn btn-success btn-ampliado">Actualizar stock</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
@endsection
