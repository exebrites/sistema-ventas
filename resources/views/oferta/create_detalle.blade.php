@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Agregar material</h1>
@stop

@section('content')
    <div class="card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            <form action="{{ route('detalleoferta.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label>Material</label>
                    <input type="text" class="form-control" id="" name="material" value="{{ $material->nombre }}">
                </div>

                <div class="mb-3">
                    <label>Marca</label>
                    <input type="text" class="form-control" id="" name="marca" required>
                </div>
                <div class="mb-3">
                    <label>Cantidad</label>
                    <input type="text" class="form-control" id="" name="cantidad" value="{{ $detalle->cantidad }}">
                </div>
                <div class="mb-3">
                    <label>Precio</label>
                    <input type="text" class="form-control" id="" name="precio" required>
                </div>

                <div class="mb-3">

                    <input type="hidden" class="form-control" id="" name="demanda_id"
                        value=" {{ $demanda_id }}">

                    <input type="hidden" class="form-control" id="" name="oferta_id" value=" {{ $oferta_id }}">

                    <input type="hidden" name="material_id" value="{{ $material->id }}">

                </div>

                <button type="submit" class="btn btn-success">Agregar materiales</button>
            </form>
        </div>
    </div>
@endsection
