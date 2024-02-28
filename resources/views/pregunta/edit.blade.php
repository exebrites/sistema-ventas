@extends('adminlte::page')

@section('title')

@section('content_header')
    Editar pregunta
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('preguntas.update',$pregunta)}}" method="post">
                @csrf
                @method('put')
                <input type="hidden" name="id" value={{ $pregunta->id }}>
                <div class="form-group">
                    <label for="">Contenido</label>
                    <input type="text" name="contenido" id="" class="form-control" placeholder=""
                        value="{{ $pregunta->contenido }}">

                </div>
                <button type="submit">Actualizar</button>
            </form>
        </div>
    </div>
@endsection
