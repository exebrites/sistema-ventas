@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Agregar un articulo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('detallepresupuestos.store') }}" method="post">

                @csrf
                <input type="hidden" name="presupuesto_id" value="{{ $presupuesto->id }}">
                <div class="form-group">
                    <label for="clientes">Productos:</label>

                    <select class="js-example-basic-single" name="producto_id">
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">
                                {{ $producto->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Cantidad</label>
                    <input type="text" name="cantidad" id="" class="form-control" placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Precio</label>
                    <input type="text" name="precio" id="" class="form-control" placeholder=""
                        aria-describedby="helpId">
                </div>

                <button type="submit">Agrega</button>

            </form>

        </div>
    </div>
@endsection
