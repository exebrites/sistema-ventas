@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

@section('content')
    <br>
    <br>

    <div class="card">
        <div class="card-body">

            {{-- {{ dd($pedidos) }} --}}
            <div class="row">
                <div class="text-center">
                    <h1>Tus pedidos </h1>
                </div>

                <div class="col-1"></div>
                <div class="col-10">

                    <div class="accordion" id="accordionExample">

                        @foreach ($pedidos as $item)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo{{ $item->id }}" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        Nro de pedido: {{ $item->id }} <br> Estado: {{ $item->estado->descripcion }}
                                        <br> Ultima
                                        actualizacion de pedido : {{ $item->updated_at->format('d-m-Y') }}
                                        {{-- <br> Te faltan x
                                        diseños por revisar --}}
                                    </button>
                                </h2>

                                <div id="collapseTwo{{ $item->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @if ($item->estado_id < 4)
                                            <td>
                                                <a href="{{ route('checkout.show', $item->id) }}">Paso a seguir para
                                                    completar el
                                                    pedido </a>
                                            </td>
                                        @endif

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    {{-- <th scope="col">#</th> --}}
                                                    <th scope="col">Producto</th>
                                                    <th scope="col">Cantidad</th>
                                                    {{-- <th scope="col">Estado de diseño</th> --}}
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($item->detallePedido as $detalle)
                                                    <tr>
                                                        {{-- <th scope="row">1</th> --}}


                                                        <td>{{ $detalle->producto->name }} </td>
                                                        <td>{{ $detalle->cantidad }} unidades</td>

                                                        {{-- <td>{{ $detalle->produccion ? 'En produccion' : 'Pre-produccion' }} --}}
                                                        </td>

                                                        {{-- {{ dd($detalle->produccion) }} --}}
                                                        @if (!$detalle->produccion)
                                                            <td>
                                                                <a id="disenio"
                                                                    href="{{ route('show_disenio', $detalle->id) }}"> ver
                                                                    diseño</a>
                                                            </td>
                                                        @endif

                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
                <div class="col-1"></div>
            </div>
            {{-- <div> <a class="btn btn-danger" href="{{ url()->previous() }}">Cancelar</a></div> --}}


        </div>
    </div>
    <script></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
@endsection
