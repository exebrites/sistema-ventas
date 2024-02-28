@extends('adminlte::page')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

@section('title')

@section('content_header')
    <h1>Proveedores</h1>
@stop

@section('content')

    {{-- {{dd($proveedores);}} --}}
    <div class="card">
        <div class="card-header">
            {{-- Agregar --}}
            <a href="{{ route('proveedores.create') }}" class="btn btn-success">Agregar nuevo producto</a>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="proveedores">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre empresa</th>
                        <th>Nombre contacto</th>
                        <th>CUIT</th>
                        <th>telefono</th>
                        <th>Correo</th>

                        <th></th>
                        <th></th>
                    </tr>

                </thead>
                <tbody>

                    @foreach ($proveedores as $item)
                        {{-- {{ dd($item) }} --}}
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nombre_empresa }}</td>
                            <td>{{ $item->nombre_contacto }}</td>
                            <td>{{ $item->cuit }}</td>
                            <td>{{ $item->telefono }}</td>
                            <td>{{ $item->correo }}</td>


                            <td width="10px"><a class="btn btn-warning btn btn-sm"
                                    href="{{ route('proveedores.edit', $item->id) }}">Editar</a></td>
                            <td width="10px">
                                <form action="{{ route('proveedores.destroy', $item->id) }}" method="post"
                                    class="formulario-eliminar">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn btn-sm" type="submit">borrar</button>
                                </form>
                            </td>


                        </tr>

                        {{-- <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">{{$item->name}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">  --}}
                        {{-- --}}
                        {{-- <img src="{{$item->image_path}}" class="img-fluid" alt="...">
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                        {{-- </div>
                          </div>
                        </div>
                      </div> --}}
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var table = new DataTable('#proveedores', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>


    {{-- implementacion de una confirmacion de borrado por el usuario --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/confirmacionBorrado.js') }}"></script>
@stop
