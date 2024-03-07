@extends('adminlte::page')
@section('title')

@section('content_header')
    <h1>Añadir articulos al presupuesto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Presupuesto creado</h3>

            <div class="form-group">
                <label for="">Numero de presupuesto</label>
                <input type="text" class="form-control" value="{{ $presupuesto->id }}" readonly>
            </div>
            <div class="form-group">
                <label for="">Fecha de entrega</label>
                <input type="text" class="form-control" value="{{ $presupuesto->fecha_entrega }}" readonly>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('detallepresupuestos.create', ['id' => $presupuesto->id]) }}">Agregar</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Articulo</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($detalles)
                        @foreach ($detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->producto_id }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>{{ $detalle->precio }}</td>
                            </tr>
                        @endforeach
                    @else
                        {{ 'no se han cargado articulos ' }}
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
