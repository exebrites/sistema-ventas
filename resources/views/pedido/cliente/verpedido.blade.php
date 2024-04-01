@extends('layouts.app')

@section('content')
    <br>
    <br>
    <br>
    {{-- {{ dd($pedido) }} --}}
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="">Numero de pedido </label>
                <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId"
                    value="{{ $pedido->id }}" readonly>
            </div>
            <div class="form-group">
                <label for="">Fecha requerida</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" readonly value="{{ $pedido->fecha_entrega }}">
            </div>
            <div class="form-group">
                <label for="">Fecha propuesta</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" readonly value="{{ $pedido->fecha_inicio }}">
            </div>
            <div class="form-group">
                <label for="">Precio total</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" readonly value="${{ $pedido->costo_total }}">
            </div>

            <br>
            <br>
            <div class="row">
                @foreach ($pedido->detallePedido as $detalle)
                    <div class="col-sm-6">
                        <div class="card" style="width: 18rem;">

                            <img src="{{ $detalle->producto->image_path }}" class="card-img-top" alt="..."
                                style="height: 300; width: 300px;display: block;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $detalle->producto->name }}</h5>

                                <a href="{{ route('show_disenio', $detalle->disenio->id) }}" class="btn btn-primary">Ver
                                    disenio</a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    </div>
@endsection
