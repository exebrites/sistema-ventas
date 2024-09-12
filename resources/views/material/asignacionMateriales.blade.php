@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Asignacion de materiales a pedidos</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <h3>Demanda</h3>

            <div class="form-group">
                <label for="">Numero de demanda</label>
                <input type="text" name="" id="" class="form-control" value="{{ $demanda->id }}" readonly>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3>pedidos</h3>

            <ul>
                @foreach ($pedidos as $pedido)
                    <li>{{ $pedido->id }}</li>
                    <ul>
                        @foreach ($pedido->listaMaterialesPedidos() as $material)
                            <li>{{ $material['id'] }} | {{ $material['cantidad'] }}</li>
                        @endforeach




                    </ul>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3>recepcion</h3>
          <ul>  @foreach ($recepciones as $recepcion)
            <li>Material: {{ $recepcion->material_id }} | Cantidad: {{ $recepcion->cantidad }}</li>
        @endforeach</ul>
        </div>
    </div>
    {{-- <div class="card">
        <div class="card-body">
            <h3>ofertas</h3>
            <ul>
                @foreach ($ofertas as $oferta)
                    <li>
                        Oferta Nro: {{ $oferta->id }}
                        <ul>
                            @foreach ($oferta->detalleOferta as $detalle)
                                <li>Detalle: {{ $detalle->material_id }}|{{ $detalle->cantidad }} </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div> --}}
@endsection
