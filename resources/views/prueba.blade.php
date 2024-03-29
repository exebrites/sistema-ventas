@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>prueba </h1>
@stop
@section('content')


    <form action="{{ route('grafico') }}" method="post">
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
        <button type="submit">enviar</button>
    </form>

@endsection
