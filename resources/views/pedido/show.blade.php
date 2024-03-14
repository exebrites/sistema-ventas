@extends('adminlte::page')
@section('title')

@section('content_header')
    <h1>Pedido</h1>
@stop

@section('content')
    {{-- {{ dd($pedido) }} --}}
    <div class="card">
        <div class="card-header">
            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Volver atrás</a>
            <a href="{{ route('clientes.show', $pedido->clientes_id) }}" class="btn btn-primary">Ver cliente</a>
            @if ($pedido->comprobante == null)
                <a href="#" class="btn btn-light"><b>No tiene comprobante</b></a>
            @else
                <a href="{{ route('comprobantes.show', $pedido->comprobante->id) }}" class="btn btn-primary">Ver
                    comprobante</a>
            @endif
            @if ($pedido->entrega == null)
                <a href="#" class="btn btn-light"> <b>No tiene lugar de entrega</b></a>
            @else
                <a href="{{ route('entrega.show', $pedido->entrega->id) }}" class="btn btn-primary">Ver entrega</a>
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
                        <label for="">Fecha Entrega</label>
                        <input type="text" name="" id="" class="form-control"
                            value="{{ $pedido->fecha_entrega }}" readonly>
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
                @foreach ($pedido->detallePedido as $detalle)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Producto: {{ $detalle->producto->name }}
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <b> Nombre del producto:</b> {{ $detalle->producto->name }} <br>
                                <b> Descripcion:</b> {{ $detalle->producto->description }} <br>
                                <b>Cantidad solicitada:</b> {{ $detalle->cantidad }} <br>
                                <a href="{{ route('productos.show', $detalle->producto->id) }}">Ver producto</a><br>
                                {{-- <a ['id' => $detalle->producto->id, 'cantidad' => $detalle->cantidad]) href="{{ route('materiales_necesarios', $detalle->id) }}"></a><br>p --}}
                                {{-- <a href="{{ route('materiales_necesarios', $detalle->id) }}">Ver stock</a><br> --}}
                                <a href="{{ route('disenios.show', $detalle->disenio->id) }}">Ver diseño</a>
                                <br>
                                @if ($detalle->boceto != null)
                                    <a href="{{ route('showBoceto', $detalle->boceto->id) }}">Ver boceto</a>
                                @endif
                                <br>

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
