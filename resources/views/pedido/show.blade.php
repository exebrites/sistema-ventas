@extends('adminlte::page')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@section('title')

@section('content_header')
    <h1>Pedido</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-header">
            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Volver atrás</a>

        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nro de pedido</th>
                        <th>Nombre de cliente</th>
                        {{-- <th>Fecha Inicio</th>
                        <th>Fecha Entrega</th> --}}
                        <th>Estado</th>
                        <th>Ver comprobante</th>
                        {{-- <th>Created At</th>
                        <th>Updated At</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->cliente->nombre }}</td>
                        {{-- <td>{{ $pedido->fecha_inicio }}</td>
                        <td>{{ $pedido->fecha_entrega }}</td> --}}
                        <td>{{ $pedido->estado->nombre }}</td>
                        {{-- <td>{{ $pedido->created_at }}</td>
                        <td>{{ $pedido->updated_at }}</td> --}}

                        @if ($pedido->comprobante == null)
                            <td>No tiene comprobante</td>
                        @else
                            <td><a href="{{ route('comprobantes.show', $pedido->comprobante->id) }}">Ver mas</a>
                            </td>
                        @endif

                    </tr>
                </tbody>
            </table>
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



    {{-- CDN according --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
@stop
