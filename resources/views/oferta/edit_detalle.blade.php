@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Agregar material</h1>
@stop

@section('content')
    {{-- {{ dd($detalle) }} --}}
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            <form action="{{ route('detalleoferta.update', $detalle) }}" method="post">

                @csrf
                @method('put')
                <div class="mb-3">
                    <input type="hidden" class="form-control" id="" name="detalle_id" value="{{ $detalle->id }}">
                </div>

                <div class="mb-3">
                    <label>Material</label>
                    <input type="text" class="form-control" id="" name="material"
                        value="{{ $detalle->nombre }}">
                </div>

                <div class="mb-3">
                    <label>Marca</label>
                    <input type="text" class="form-control" id="" name="marca" value="{{ $detalle->marca }}">>
                </div>
                <div class="mb-3">
                    <label>Cantidad</label>
                    <input type="text" class="form-control" id="" name="cantidad"
                        value="{{ $detalle->cantidad }}">>
                </div>
                <div class="mb-3">
                    <label>Precio</label>
                    <input type="text" class="form-control" id="" name="precio"
                        value="{{ $detalle->precio }}">>
                </div>

                {{-- <div class="mb-3">

                    <input type="hidden" class="form-control" id="" name="demanda_id"
                        value=" {{ $demanda_id }}">

                    <input type="hidden" class="form-control" id="" name="oferta_id" value=" {{ $oferta_id }}">


                </div> --}}

                <button type="submit" class="btn btn-success">actualizar materiales</button>
            </form>
        </div>
    </div>
@endsection
