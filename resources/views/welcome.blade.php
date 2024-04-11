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
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $nroboceto }}</h3>
                                <p>Numero de bocetos solicitados</p>
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
                                <p>Numero de diseños para revision</p>
                            </div>
                            {{-- <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div> --}}
                            {{-- <a href="#" class="small-box-footer">
                                Ver mas <i class="fas fa-arrow-circle-right"></i>
                            </a> --}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $nroofertas }}</h3>
                                <p>Numero de ofertas pendientes</p>
                            </div>
                            {{-- <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div> --}}
                            {{-- <a href="#" class="small-box-footer">
                                Ver mas <i class="fas fa-arrow-circle-right"></i>
                            </a> --}}
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="small-box bg-default">
                            <div class="inner">
                                <h3>{{ $nroPedidoImprenta }}</h3>
                                <p>Numero pedidos en confirmacion de imprenta</p>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        {{-- <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $nroofertas }}</h3>
                                <p>Numero de ofertas pendientes</p>
                            </div>
                        </div> --}}

                    </div>
                </div>



            </div>
        </div>
    @stop
