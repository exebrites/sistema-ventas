@extends('adminlte::page')

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
            <table class="table table-striped table-bordered" id="materiales">

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
                            <td><a class="btn btn-warning btn btn-sm btn-fixed-width"
                                    href="{{ route('materiales.edit', $item->id) }}">Editar</a></td>
                            <td>
                                <form action="{{ route('materiales.destroy', $item->id) }}" method="post"
                                    class="formulario-eliminar">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn btn-sm btn-fixed-width" type="submit">Borrar</button>
                                </form>
                            </td>
                            <td><a class="btn btn-primary btn btn-sm btn-fixed-width"
                                    href="{{ route('materiales.stock', $item->id) }}">Stock</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>

@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/btnFijo.css') }}">
    {{-- btn-fixed-width --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    {{-- DATATABLE --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css">
@endsection
@section('js')



    {{-- DATATABLE --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#materiales', {
            language: {
                info: 'Mostrar registros de _START_ a _END_ ',
                infoEmpty: 'No hay registros',
                infoFiltered: '(filtered from _MAX_ total records)',
                lengthMenu: 'Mostrar _MENU_ registros',
                zeroRecords: 'No se encontraron coincidencias',
                search: 'Buscar:',

                emptyTable: 'No hay datos disponibles',
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>


    {{-- implementacion de una confirmacion de borrado por el usuario --}}


    {{-- Dentro del from de eliminar agregar - >  class="formulario-eliminar" --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/confirmacionBorrado.js') }}"></script>


@endsection
