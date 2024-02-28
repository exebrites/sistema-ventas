@extends('adminlte::page')

@section('title')

@section('content_header')
    Preguntas
@stop

@section('content')
    {{-- {{ dd($preguntas) }} --}}
    <a href="{{ route('preguntas.create') }}">Agregar nueva pregunta</a>
    <table class="table">
        <thead>
            <tr>
                <th>Numero de pregunta</th>
                <th>Contenido</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($preguntas as $pregunta)
                <tr>
                    <td scope="row">{{ $pregunta->id }}</td>
                    <td>{{ $pregunta->contenido }}</td>
                    <td width="10px"><a class="btn btn-warning btn btn-sm"
                            href="{{ route('preguntas.edit', $pregunta->id) }}">Editar</a></td>
                    <td width="10px">
                        <form action="{{ route('preguntas.destroy', $pregunta->id) }}" method="post"
                            class="formulario-eliminar">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn btn-sm " type="submit">borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
