@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Reporte de clientes </h1>
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
            <select class="form-control" id="cliente" name="cliente_id" required>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }} </option>
                @endforeach
            </select>
        </div>
        <button type="submit">enviar</button>
    </form>

@endsection
