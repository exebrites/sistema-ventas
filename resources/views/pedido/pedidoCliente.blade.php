@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
@section('content')
    <br>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="text-center">
                    <h1>Tus pedidos </h1>
                </div>
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="accordion" id="accordionExample">
                        @foreach ($pedidos as $pedido)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo{{ $pedido->id }}" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        Nro de pedido: {{ $pedido->id }} <br> Estado: {{ $pedido->estado->descripcion }}
                                        <br> Ultima
                                        actualizacion de pedido : {{ $pedido->updated_at->format('d-m-Y') }}
                                    </button>
                                </h2>
                                <div id="collapseTwo{{ $pedido->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @if ($pedido->estado_id < 4)
                                            <td>
                                                <a href="{{ route('checkout.show', $item->id) }}">Paso a seguir para
                                                    completar el
                                                    pedido </a>
                                            </td>
                                        @endif
                                        <br>
                                        <a href="{{ route('verpedidos', ['pedido_id' => $item->id]) }}">Ver pedido</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>
    <script></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
@endsection
