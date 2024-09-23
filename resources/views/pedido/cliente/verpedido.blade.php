@extends('layouts.app')

@section('content')
    <br>
    <br>
    <br>
    {{-- {{ dd($pedido) }} --}}
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
            {{-- <div class="form-group">
                <label for="">Fecha requerida</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" readonly value="{{ $pedido->fecha_entrega }}">
            </div> --}}
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
            {{-- <div class="row"> --}}

            <div style="display: flex; justify-content: center;">
                {{-- @if ($busqueda->count() > 0) --}}
                {{-- @foreach ($busqueda as $producto) --}}
                @foreach ($pedido->detallePedido as $detalle)
                    <div class="card" style="width: 18rem; margin: 5px;">
                        {{-- <img src="{{ $producto->image_path }}" class="card-img-top" alt="..."> --}}
                        <div class="card-body">
                            <img src="{{ $detalle->producto->image_path }}" class="card-img-top mx-auto"
                                style="height: 150px; width: 150px;display: block;">
                            <br>


                            {{-- <h5 class="card-title"></h5> --}}
                            <small>{{ $detalle->producto->name }}</small>

                            <br>
                            <br>
                            <div>
                                <?php $disenio = $costoDisenio->costo_disenio($detalle->producto->price, $detalle->cantidad, $detalle->disenio->disenio_estado);
                                ?>
                                Costo unitario :$ {{ $detalle->producto->price }} <br>
                                Cantidad : {{ $detalle->cantidad }} u.
                                <br>
                                Costo de diseño: $ {{$disenio}}
                                <br>
                                Costo subtotal: $ {{ $detalle->subtotal + $disenio }} <br>

                                @if ($detalle->produccion === 0)
                                    @if ($detalle->disenio->revision === 0)
                                        <b style="color:red">Revisar diseño</b>
                                    @endif
                                @else
                                    <b style="color:green">Diseño aprobado</b>
                                @endif <br>
                                <br>
                                @if ($pedido->estado->nombre == 'disenio')
                                    <a href="{{ route('show_disenio', $detalle->disenio->id) }}" class="btn btn-primary">Ver
                                        disenio</a><br>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- </div> --}}
        </div>

    </div>
    </div>
@endsection
