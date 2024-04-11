@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Pedidos Cancelados y NO cancelados por cliente </h1>
@stop
@section('content')


    <form action="{{ route('graficoCliente') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Fecha de inicio</label>
            <input type="date" name="inicio" id="" class="form-control" required>
            @error('inicio')
                <br>
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Fecha final</label>
            <input type="date" name="final" id="" class="form-control" required>
            @error('final')
                <br>
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="cliente">Clientes</label>
            <select class=" form-control js-example-basic-single " id="cliente" name="cliente_id" required>
                <option value=" ">Seleccionar</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }} </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Generar grafico</button>
    </form>



@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('js')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
