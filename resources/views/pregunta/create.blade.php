@extends('adminlte::page')

@section('title')

@section('content_header')
    Agregar nueva pregunta
@stop

@section('content')
    <form action="{{ route('preguntas.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Contenido de la pregunta</label>
            <input type="text" name="contenido" id="" class="form-control"
                placeholder="Escriba la pregunta que quiere" aria-describedby="helpId">

        </div>

        <button type="submit">Agregar </button>
    </form>
@endsection
