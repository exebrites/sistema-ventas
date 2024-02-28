@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
@section('title')

@section('content_header')
    <h1>Editar informacion de la empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            <form action="{{ route('contacto.update', 1) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="">Correo electronico</label>
                    <input type="email" name="email" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $contacto['correo'] }}">

                </div>
                <div class="form-group">
                    <label for="">Telefono de contacto</label>
                    <input type="tel" name="telefono" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $contacto['telefono'] }}">

                </div>
                <div class="form-group">
                    <label for="">Direccion </label>
                    <input type="text" name="direccion" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $contacto['direccion'] }}">

                </div>
                

                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="{{route('contacto.index')}}" class="btn btn-danger btn-ampliado">Cancelar</a>
                            </div>


                            <div>
                                <button type="submit" class="btn btn-success btn-ampliado">Agregar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
