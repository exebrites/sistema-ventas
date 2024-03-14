@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
@section('title')

@section('content_header')
    <h1>Editar pedido</h1>
@stop
{{-- 
        ***PENDIENTES***    
    
        ### Que valor tiene pedido ?

        ###NO mandar "seleccionar" 
        
        --}}
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
                {{-- <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion"
                        value="{{ $pedido->descripcion }}" required>
                </div> --}}
                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select class="form-control" id="estado" name="estado" required>
                        <option value="pendiente_pago" @if ($pedido->estado->nombre == 'pendiente_pago') selected @endif>Pendiente de pago
                        </option>
                        <option value="confirmado_pago" @if ($pedido->estado->nombre == 'confirmado_pago') selected @endif>Confirmado de pago
                        </option>
                        <option value="inicio" @if ($pedido->estado->nombre == 'inicio') selected @endif>Inicio</option>
                        <option value="disenio" @if ($pedido->estado->nombre == 'disenio') selected @endif>Diseño</option>
                        pre_produccion
                        <option value="pre_produccion" @if ($pedido->estado->nombre == 'pre_produccion') selected @endif>Pre produccion
                        </option>
                        <option value="produccion" @if ($pedido->estado->nombre == 'produccion') selected @endif>Produccion</option>
                        <option value="terminado" @if ($pedido->estado->nombre == 'terminado') selected @endif>Terminado
                        </option>
                        <option value="entregado" @if ($pedido->estado->nombre == 'entregado') selected @endif>Entregado
                        </option>
                        <option value="en_confirmacion_imprenta" @if ($pedido->estado->nombre == 'en_confirmacion_imprenta') selected @endif>En
                            confirmacion de imprenta
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Fecha de requerida </label>
                    <input type="date" name="fecha_entrega" id="" class="form-control"
                        value="{{ $pedido->fecha_entrega }}" readonly>

                </div>
                <div class="form-group">
                    <label for="">Fecha de entrega </label>
                    <input type="date" name="fecha_e" id="" class="form-control">

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
