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
                {{ 'Se retira en local ' }}
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
