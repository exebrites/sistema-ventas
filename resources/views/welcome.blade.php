@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Bienvenido {{ $user->name }}</h1>
@stop

@section('content')
    <div class="card">
        {{-- {{ dd($NroRevision) }} --}}
        <div class="card-body ">


            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $NroComprobantes }}</h3>
                                <p>Numero de pedidos con pago pendiente</p>
                                <a href="{{ route('ver_pedido', 2) }}">Ver pedidos </a>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $nroboceto }}</h3>
                                <p>Numero de pedidos con bocetos solicitados</p>
                                <a href="{{ route('ver_pedido_boceto') }}">Ver pedidos</a>
                            </div>
                            {{-- <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div> --}}
                            {{-- <a href="{{ route('disenios.index') }}" class="small-box-footer">
                                Ver mas <i class="fas fa-arrow-circle-right"></i>
                            </a> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $NroRevision }}</h3>
                                <p>Numero de pedidos con diseños para revision</p>
                                <a href="{{ route('ver_pedido_disenio_revision') }}">Ver pedidos </a>
                            </div>                            
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $nroofertas }}</h3>
                                <p>Numero de ofertas pendientes</p>
                                <a href="{{ route('ver_oferta', 'pendiente') }}">Ver oferta</a>
                            </div>
                            
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="small-box bg-default">
                            <div class="inner">
                                <h3>{{ $nroPedidoImprenta }}</h3>
                                <p>Numero pedidos en confirmacion de imprenta</p>
                                <a href="{{ route('ver_pedido', 1) }}">Ver pedidos </a>

                            </div>

                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="small-box bg-default">
                            <div class="inner">
                                <h3>{{ $nroPedidosDiseniosAprobados }}</h3>
                                <p>Numero de pedidos con diseños aprobados</p>
                                <a href="{{ route('ver_pedido_disenio_aprobado') }}">Ver pedidos </a>

                            </div>

                        </div>
                    </div>
                </div>



            </div>
        </div>
    @stop
