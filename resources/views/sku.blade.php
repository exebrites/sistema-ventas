@extends('adminlte::page')
@section('title')
@section('content_header')
    <h1>Generacion de sku</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
            {{-- <a href="{{ route('detalleproducto.show', $producto->id) }}" class="btn btn-primary">Fabricacion producto</a> --}}
        </div>
        <div class="card-body">
            <form action="{{ route('storeSku') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="mb-3">
                    <label for="tipo_sku" class="form-label">Tipo de SKU</label>
                    <select name="tipo" id="tipo_sku" class="form-select">
                        <option value="A">Formato 1</option>
                        <option value="B">Formato 2</option>
                        <option value="C">Formato 3</option>
                        {{-- <option value="D">Formato 4</option> --}}
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Generar SKU</button>
            </form>

        </div>
    </div>

@stop
