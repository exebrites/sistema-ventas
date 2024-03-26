@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
@section('title')

@section('content_header')
    <h1> Editar Demanda/Orden de compra</h1>
@stop

@section('content')

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>


        <div class="card-body">
            <div class="form-group">
                <label for="">Numero de demanda</label>
                <input type="text" name="" id="" class="form-control" value="{{ $demanda->id }}"
                    readonly>
            </div>
            <div class="form-group">
                <label for="">Fecha de cierre</label>
                <input type="text" name="" id="" class="form-control"
                    value="{{ $demanda->fecha_cierre->format('d-m-Y') }}" readonly>
            </div>
            <hr>
            <form action="{{ route('demandas.update', $demanda) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for=""></label>
                    <input type="hidden" name="id" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $demanda->id }}">
                </div>
                <div class="form-group">
                    <label for="">Nueva fecha de cierre</label>
                    <input type="date" name="f_cierre" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" >
                </div>


                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="{{ route('demandas.index') }}" class="btn btn-danger btn-ampliado">Cancelar</a>
                            </div>


                            <div>
                                <button type="submit" class="btn btn-success btn-ampliado">Actualizar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
