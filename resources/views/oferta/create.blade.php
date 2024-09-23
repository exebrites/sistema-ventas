@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Crear oferta</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
        
                </div>
        <div class="card-body">
            <h5>Información de demanda</h5>

            <div class="form-group">
                <label for="">Número de demanda</label>
                <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId"
                    value="{{ $demanda->id }}" readonly>
            </div>
            <div class="form-group">
                <label for="">Fecha de cierre de la orden de compra</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ $demanda->fecha_cierre }}" readonly>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <form action="{{ route('ofertas.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="fecha_entrega">Fecha de entrega de la oferta</label>
                    <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control"
                        aria-describedby="helpId" required>
                    <input type="hidden" name="demanda_id" value="{{ $demanda->id }}">
                    <input type="hidden" name="proveedor_id" value="{{ $proveedor->id }}">
                </div>
                <button type="submit" class="btn btn-success">Crear Oferta</button>
            </form>
        </div>
    </div>
@endsection
