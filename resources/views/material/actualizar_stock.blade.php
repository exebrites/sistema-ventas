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
            <div class="row">

                <div class="col d-flex">
                    <div style="width: 40%">
                        <label for="">Cantidad de stock: </label>
                        <input type="text" readonly value="{{ $material->stock }}" class="form-control ">
                    </div>
                    <div style="width: 10%">
                        {{-- <label for="">Cantidad de stock: </label>
                        <input type="text" readonly value="{{ $material->stock }}" class="form-control "> --}}
                    </div>
                    <div style="width: 40%">
                        <label for="">Fecha de adquisicion: </label>
                        <input type="text" readonly value="{{ $material->fecha_adquisicion }}" class="form-control ">
                    </div>
                </div>
            </div>
        </div>

        {{-- 


        <div class="card-body">

            <div class="row">

                <div class="col d-flex">


                    <form action="{{ route('materiales.stock_update', $material) }}" method="post">
                        @csrf
                        @method('PUT')

                        <input type="hidden" class="form-control" name="id" value="{{ $material->id }}" readonly>




                        <div class="row">

                            <div class="col d-flex">
                                <div style="width: 40%">
                                    <label>*Cantidad en stock</label> <br>
                                    <input type="text" class="form-control" name="stock" value="">
                                </div>

                                <div style="width: 40%">
                                    <label>*Fecha de adquisicion</label>
                                    <input type="text" class="form-control" name="f_adquisicion" value="">
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        

                    </form>

                </div>
            </div> 

        </div> --}}



        <div class="card-body">
            <div class="container mt-4">
                <form action="tu_archivo_php.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cantidadStock">Cantidad de Stock:</label>
                            <input type="number" class="form-control" id="cantidadStock" name="cantidadStock" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fechaReposicion">Fecha de Reposición:</label>
                            <input type="date" class="form-control" id="fechaReposicion" name="fechaReposicion" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="{{route('materiales.index')}}" class="btn btn-danger btn-ampliado">Cancelar</a>
                            </div>


                            <div>
                                <button type="submit" class="btn btn-primary btn-ampliado">Agregar</button>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
