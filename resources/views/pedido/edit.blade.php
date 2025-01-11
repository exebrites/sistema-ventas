@extends('adminlte::page')
@section('title')
@section('content_header')
    <h1>Editar pedido</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-body">
            <form action="{{ route('pedidos.update', ['pedido' => $pedido]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Numero de pedido</label>
                    <input type="text" class="form-control" value="{{ $pedido->id }}" readonly name="pedido_id">
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select class="form-control" id="estado" name="estado" required>
                        @if ($pedido->estado->nombre == 'en_confirmacion_imprenta')
                            <option value="en_confirmacion_imprenta" @if ($pedido->estado->nombre == 'en_confirmacion_imprenta') selected  @endif>En
                                confirmacion de imprenta
                            </option>                         
                            <option value="cancelado" @if ($pedido->estado->nombre == 'cancelado') selected @endif>Cancelado
                            </option>
                        @elseif($pedido->estado->nombre == 'pendiente_pago')
                            <option value="pendiente_pago" @if ($pedido->estado->nombre == 'pendiente_pago') selected @endif>Pendiente de
                                pago
                            </option>
                            <option value="confirmado_pago">Confirmado de
                                pago
                            </option>
                            <option value="cancelado" @if ($pedido->estado->nombre == 'cancelado') selected @endif>Cancelado
                            </option>
                        @elseif ($pedido->estado->nombre == 'confirmado_pago')
                            <option value="confirmado_pago" @if ($pedido->estado->nombre == 'confirmado_pago') selected @endif>Confirmado de
                                pago
                            </option>
                            <option value="inicio">Inicio</option>
                            <option value="cancelado">Cancelado
                            </option>
                        @elseif($pedido->estado->nombre == 'inicio')
                            <option value="inicio" @if ($pedido->estado->nombre == 'inicio') selected @endif>Inicio</option>
                            <option value="disenio">Diseño</option>
                            <option value="cancelado">Cancelado
                            </option>
                        @elseif($pedido->estado->nombre == 'disenio')
                            <option value="disenio" @if ($pedido->estado->nombre == 'disenio') selected @endif>Diseño</option>
                            <option value="pre_produccion">Pre produccion
                            </option>
                            </option>
                        @elseif($pedido->estado->nombre == 'pre_produccion')
                            <option value="pre_produccion" @if ($pedido->estado->nombre == 'pre_produccion') selected @endif>Pre produccion
                            </option>
                            <option value="produccion">Produccion</option>
                        @elseif($pedido->estado->nombre == 'produccion')
                            <option value="produccion" @if ($pedido->estado->nombre == 'produccion') selected @endif>Produccion
                            </option>
                            <option value="terminado">Terminado
                            </option>
                        @elseif($pedido->estado->nombre == 'terminado')
                            <option value="terminado" @if ($pedido->estado->nombre == 'terminado') selected @endif>Terminado
                            </option>
                            <option value="despachado">Despachado
                            </option>
                        @elseif($pedido->estado->nombre == 'despachado')
                            <option value="despachado" @if ($pedido->estado->nombre == 'despachado') selected @endif>Despachado
                            </option>
                            <option value="entregado">Entregado
                            </option>
                        @elseif($pedido->estado->nombre == 'entregado')
                            <option value="entregado" @if ($pedido->estado->nombre == 'entregado') selected @endif>Entregado
                            </option>
                        @endif
                    </select>
                </div>
                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">
                            <div id="btn-cancelar">
                                <a href="{{ route('pedidos.index') }}" class="btn btn-danger btn-ampliado">Cancelar</a>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success btn-ampliado">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
@endsection
