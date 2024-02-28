@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Bienvenido {{ $user->name }}</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body ">

            
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$NroComprobantes}}</h3>
                                <p>Comprobantes pendientes</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <a href="{{route('comprobantes.index')}}" class="small-box-footer">
                                Ver mas <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{$NroDisenios}}</h3>
                                <p>Nuevos diseños</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <a href="{{route('disenios.index')}}" class="small-box-footer">
                                Ver mas <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col-md-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{$NroPedidos}}</h3>
                                <p>Nuevos pedidos</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Ver mas <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>Falta parametrizar</h3>
                                <p>Ofertas de proveedores</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                               Ver mas <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div> --}}
                       
                </div>
            </div>
            
            
            
        </div>
    </div>
@stop
