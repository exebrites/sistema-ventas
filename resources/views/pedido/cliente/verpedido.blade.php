@extends('layouts.app')
@section('content')
    <br>
    <br>
    <br>
    <div class="card">
        @if (session('msg_success'))
            <div class="alert alert-success">
                {{ session('msg_success') }}
            </div>
        @endif
        <div class="card-body">
            <div class="form-group">
                <label for="">Número de pedido </label>
                <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId"
                    value="{{ $pedido->id }}" readonly>
            </div>
            <div class="form-group">
                <label for="">Fecha de entrega</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" readonly value="{{ $pedido->fecha_inicio ?? 'No hay fecha propuesta' }}">
            </div>
            <div class="form-group">
                <label for="">Precio total</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" readonly value="${{ $pedido->costo_total }}">
            </div>
            <br>
            <br>
            <div style="display: flex; justify-content: center;">
                @foreach ($pedido->detallesPedido as $detalle)
                    <div class="card" style="width: 18rem; margin: 5px;">
                        <div class="card-body">
                            <img src="{{ $detalle->producto->imagen }}" class="card-img-top mx-auto"
                                style="height: 150px; width: 150px;display: block;">
                            <br>
                            <small>{{ $detalle->producto->nombre }}</small>
                            <br>
                            <br>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
