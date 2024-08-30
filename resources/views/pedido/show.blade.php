@extends('adminlte::page')
@section('title')

@section('content_header')
    <h1>Pedido</h1>
@stop

@section('content')
    {{-- {{ dd($pedido->entrega) }} --}}
    <div class="card">
        @if (session('msg_success'))
            <div class="alert alert-success">
                {{ session('msg_success') }}
            </div>
        @endif

        <div class="card-header">
            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Volver atrás</a>
            <a href="{{ route('clientes.show', $pedido->clientes_id) }}" class="btn btn-primary">Ver cliente</a>
            @if ($pedido->comprobante == null)
                <a href="#" class="btn btn-light"><b>No tiene comprobante</b></a>
            @else
                <a href="{{ route('comprobantes.show', $pedido->comprobante->id) }}" class="btn btn-primary">Ver
                    comprobante</a>
            @endif
            {{-- {{dd($pedido->entrega)}} --}}
            @if ($pedido->entrega === null)
                <a href="#" class="btn btn-light"> <b>No tiene lugar de entrega</b></a>
            @else
                <a href="{{ route('entrega.show', $pedido->entrega[0]->id) }}" class="btn btn-primary">Ver entrega</a>
            @endif

            @if ($pedido->comprobante == null)
                <a href="#" class="btn btn-light"> <b>No se ha confirmado el pago</b></a>
            @else
                <a href="{{ route('factura', $pedido->id) }}" class="btn btn-primary">Generar factura</a>
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
                            value="{{ $pedido->fecha_inicio }}" readonly>
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
                        <h2 class="accordion-header" id="{{ $pedido->id }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne{{ $detalle->id }}" aria-expanded="true"
                                aria-controls="collapseOne">
                                Producto: {{ $detalle->producto->name }}
                            </button>
                        </h2>
                        <div id="collapseOne{{ $detalle->id }}" class="accordion-collapse collapse show "
                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <b> Nombre del producto:</b> {{ $detalle->producto->name }} <br>
                                <b> Descripcion:</b> {{ $detalle->producto->description }} <br>
                                <b>Cantidad solicitada:</b> {{ $detalle->cantidad }} <br>
                                <b>Diseño Aprobado :</b> {{ $detalle->produccion ? 'Si' : 'NO' }} <br>
                                <b>Con Diseño:</b> {{ $detalle->disenio->disenio_estado ? 'Si ' : 'No' }} <br>

                                @if ($detalle->disenio->disenio_estado === 1)
                                    <b> Estado del diseño: </b>
                                    @if ($detalle->disenio->revision === 0)
                                        @if ($detalle->produccion === 0)
                                            <b style="color:green">Diseño enviado al cliente</b>
                                        @else
                                            <b style="color:green">Diseño Aprobado</b>
                                        @endif
                                    @else
                                        <b style="color:red">Realizar revisión del diseño </b>
                                    @endif
                                @endif
                                <br>
                                <br>
                                <a href="{{ route('productos.show', $detalle->producto->id) }}" class="btn btn-primary">Ver
                                    producto</a>

                                @if ($pedido->estado->id >= 5)
                                    <a href="{{ route('disenios.show', $detalle->disenio->id) }}"
                                        class="btn btn-primary">Ver
                                        diseño</a>

                                    @if ($detalle->boceto != null)
                                        <a href="{{ route('showBoceto', $detalle->boceto->id) }}"
                                            class="btn btn-primary">Ver
                                            boceto</a>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>


    {{-- <div class="accordion" id="accordionPanelsStayOpenExample">
        @foreach ($pedido->detallePedido as $detalle)
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-{{ $detalle->id }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-{{ $detalle->id }}" aria-expanded="true"
                        aria-controls="panelsStayOpen-{{ $detalle->id }}">
                        Detalle del Pedido #{{ $detalle->id }}
                    </button>
                </h2>
                <div id="panelsStayOpen-{{ $detalle->id }}" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-{{ $detalle->id }}">
                    <div class="accordion-body">
                        <strong>Este es el cuerpo del acordeón del ítem #{{ $detalle->id }}.</strong> Se muestra por
                        defecto, hasta que el plugin de colapso agrega las clases apropiadas que usamos para dar estilo a
                        cada elemento. Estas clases controlan la apariencia general, así como la visualización y ocultamiento
                        mediante transiciones CSS. Puedes modificar cualquiera de esto con CSS personalizado o sobrescribiendo
                        nuestras variables predeterminadas. También vale la pena señalar que casi cualquier HTML puede ir dentro
                        del <code>.accordion-body</code>, aunque la transición limita el desbordamiento.
                    </div>
                </div>
            </div>
        @endforeach
    </div> --}}
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
