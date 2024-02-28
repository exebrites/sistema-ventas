@extends('adminlte::page')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

@section('title')

@section('content_header')
    <h1>Materiales</h1>
@stop

@section('content')


    <div class="card">
        <div class="card-header">

            <a href="{{ route('materiales.create') }}" class="btn btn-success">Agregar nuevo material</a>

        </div>
        <br>
        <br>
        <div class="card-body">
            <table class="table table-striped" id="materiales">
                <thead>
                    <tr>

                        <th>Codigo interno</th>

                        <th>Nombre de Material</th>
                        <th>Descripcion</th>
                        <th>Cantidad en stock</th>

                        <th>Fecha de adquisicion</th>

                        <th>Precio de compra</th>



                        <th></th>
                        <th></th>

                        {{-- <th></th> --}}
                    </tr>

                </thead>
                <tbody>

                    @foreach ($materiales as $item)
                        <tr>
                            <td>{{ $item->cod_interno }}</td>

                            <td>{{ $item->nombre }}</td>


                            <td>
                                <p>{{ $item->descripcion }}</p>
                            </td>
                            <td>{{ $item->stock }}</td>
                            <td>{{ $item->fecha_adquisicion }}</td>

                            <td>{{ $item->precio_compra }}</td>
                            <td width="10px"><a class="btn btn-warning btn btn-sm"
                                    href="{{ route('materiales.edit', $item->id) }}">Editar</a></td>
                            <td width="10px">
                                <form action="{{ route('materiales.destroy', $item->id) }}" method="post"
                                    class="formulario-eliminar">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn btn-sm" type="submit">borrar</button>
                                </form>
                            </td>
                            {{-- <td width="10px"><a class="btn btn-primary btn btn-sm"
                                    href="{{ route('materiales.stock', $item->id) }}">Actualizar stock</a></td> --}}


                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var table = new DataTable('#materiales', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>


    {{-- implementacion de una confirmacion de borrado por el usuario --}}


    {{-- Dentro del from de eliminar agregar - >  class="formulario-eliminar" --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/confirmacionBorrado.js') }}"></script>


@stop
