@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Productos</h1>
@stop

@section('content')
    <div class="card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-header">

            <a href="{{ route('productos.create') }}" class="btn btn-success">Agregar nuevo producto</a>
        </div>
        <div class="card-body">
            <h5> Criterios de busqueda
            </h5><br>
            <div class="row">
                <div class="col d-flex">
                    <div style="width: 30%" class="mx-2">
                        <label for="">Nombre del producto</label>
                        <input type="text" id="iptNombre" class="form-control" placeholder="ingrese el nombre"
                            data-index="1">
                    </div>
                    <div style="width: 30%" class="mx-2">
                        <label for="">Alias del producto</label>

                        <input type="text" id="iptAlias" class="form-control" placeholder="ingrese el alias"
                            data-index="2">
                    </div>

                    <div style="width: 30%" class="mx-2">
                        <label for="">Descripcion del producto</label>

                        <input type="text" id="iptDescripcion" class="form-control" placeholder="ingrese la Descripcion"
                            data-index="4">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered" id="productos">
                <thead>
                    <tr>
                        {{-- <th>ID</th> --}}
                        <th>Producto</th>
                        <th>Alias</th>
                        <th>Precio de venta</th>
                        <th>Descripción</th>
                        {{-- <th></th> --}}
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $item)
                        <tr>
                            {{-- <td>{{ $item->id }}</td> --}}
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->alias }}</td>
                            <td>${{ $item->price }}</td>
                            <td>{{ $item->description }}</td>
                            {{-- <td>
                                <button type="button" class="btn btn-primary btn btn-sm btn-fixed-width" data-toggle="modal"
                                    data-target="#exampleModal{{ $item->id }}">
                                    Ver imagen </button>
                            </td> --}}
                            <td width="10px"><a class="btn btn-warning btn btn-sm btn-fixed-width"
                                    href="{{ route('productos.edit', $item->id) }}">Editar</a></td>
                            <td width="10px">
                                <form action="{{ route('productos.destroy', $item->id) }}" method="post"
                                    class="formulario-eliminar">
                                    @csrf
                                    @method('delete')
                                    <button id="tuBotonId" class="btn btn-danger btn btn-sm btn-fixed-width"
                                        type="submit">Borrar</button>
                                </form>
                            </td>
                            <td width="10px"><a class="btn btn-secondary btn btn-sm btn-fixed-width"
                                    href="{{ route('productos.show', $item->id) }}">Ver mas</a></td>
                        </tr>
                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $item->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ $item->image_path }}" class="img-fluid" alt="...">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/btnFijo.css') }}">
    {{-- btn-fixed-width --}}
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var table = new DataTable('#productos', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
        $('#iptNombre').keyup(function() {
            table.column($(this).data('index')).search(this.value).draw();
        })
        $('#iptAlias').keyup(function() {
            table.column($(this).data('index')).search(this.value).draw();
        })
        $('#iptDescripcion').keyup(function() {
            table.column($(this).data('index')).search(this.value).draw();
        })
    </script>
    <script></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    {{-- implementacion de una confirmacion de borrado por el usuario --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/confirmacionBorrado.js') }}"></script>
@endsection
