@extends('adminlte::page')
@section('title')
@section('content_header')
    <h1>Pedido</h1>
@stop
@section('content')
    <div class="card">
        @if (session('msg_success'))
            <div class="alert alert-success">
                {{ session('msg_success') }}
            </div>
        @endif
        <div class="card-header">
            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Volver atrás</a>
            <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-primary">Ir al pedido </a>
            <a href="{{ route('clientes.show', $pedido->clientes_id) }}" class="btn btn-primary">Ver cliente</a>
            @if ($pedido->estado->nombre === 'pre_produccion')
                <a href="{{ route('ver_stock', $pedido) }}" class="btn btn-primary">Lista de materiales</a>
            @endif
            @if ($pedido->estado->id >= 8)
                <a href="{{ route('generarPDFDespacho', $pedido) }}" class="btn btn-primary">Control de entrega</a>
            @endif
        </div>
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-group">
                        <label for="">Numero de pedido</label>
                        <input type="text" name="" id="" class="form-control" value="{{ $pedido->id }}"
                            readonly>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="">Estado</label>
                        <input type="text" name="" id="" class="form-control"
                            value="{{ $pedido->estado->descripcion }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="accordion" id="accordionExample">
                @foreach ($pedido->detallesPedido as $detalle)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="{{ $pedido->id }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne{{ $detalle->id }}" aria-expanded="true"
                                aria-controls="collapseOne">
                                Producto: {{ $detalle->producto->nombre }}
                            </button>
                        </h2>
                        <div id="collapseOne{{ $detalle->id }}" class="accordion-collapse collapse show "
                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <b> Nombre del producto:</b> {{ $detalle->producto->nombre }} <br>
                                <b> Descripcion:</b> {{ $detalle->producto->descripcion }} <br>
                                <b>Cantidad solicitada:</b> {{ $detalle->cantidad }} <br>
                                <a href="{{ route('productos.show', $detalle->producto->id) }}" class="btn btn-primary">Ver
                                    producto</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
@endsection
