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
                        @if ($pedido->estado->nombre == 'pendiente')
                            <option value="despachado" @if ($pedido->estado->nombre == 'despachado') selected @endif>
                                {{ $pedido->estado->descripcion }}
                            </option>
                            <option value="cancelado" @if ($pedido->estado->nombre == 'cancelado') selected @endif>Cancelado
                            </option>
                        @elseif($pedido->estado->nombre == 'despachado')
                            <option value="despachado" @if ($pedido->estado->nombre == 'despachado') selected @endif>
                                {{ $pedido->estado->descripcion }}
                            </option>
                            <option value="cancelado" @if ($pedido->estado->nombre == 'cancelado') selected @endif>Cancelado
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
