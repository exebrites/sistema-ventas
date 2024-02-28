@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Agregar nuevo rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Nombre del rol</label>
                    <input type="text" name="name" id="" class="form-control" placeholder=""
                        aria-describedby="helpId">
                    {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                </div>


                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="" class="btn btn-danger btn-ampliado">Cancelar</a>
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
@section('css')
    <link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
@endsection
