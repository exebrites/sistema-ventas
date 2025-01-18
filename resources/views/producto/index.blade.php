@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Productos</h1>
@stop

@section('content')
    <div class="card">

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
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

                        <th>Producto</th>
                        <th>Alias</th>
                        <th>Precio de venta</th>
                        <th>Descripción</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->alias }}</td>
                            <td>${{ $producto->precio }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td width="10px"><a class="btn btn-warning btn btn-sm btn-fixed-width"
                                    href="{{ route('productos.edit', $producto->id) }}">Editar</a></td>
                            <td width="10px">
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="post"
                                    class="formulario-eliminar">
                                    @csrf
                                    @method('delete')
                                    <button id="tuBotonId" class="btn btn-danger btn btn-sm btn-fixed-width"
                                        type="submit">Borrar</button>
                                </form>
                            </td>
                            {{-- <td width="10px"><a class="btn btn-warning btn btn-sm btn-fixed-width"
                                href="#">Actualizar stock</a></td> --}}
                            <td> <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Actualizar stock
                                </button></td>

                            <td width="10px"><a class="btn btn-secondary btn btn-sm btn-fixed-width"
                                    href="{{ route('productos.show', $producto->id) }}">Ver mas</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Button trigger modal -->

            <!-- Modal -->
            {{-- <form action="{{ route('actualizarStock', $producto->id) }}" method="post">
                @csrf
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">



                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Stock Actual</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder=""
                                        value="{{ $producto->stock }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Cantidades</label>
                                    <input type="number" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Ingresa cantidades" name ="cantidad">
                                </div>
                                <input type="hidden" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Ingresa cantidades" name ="id" value="{{ $producto->id }}">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Actualizar stock</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form> --}}
        </div>
    </div>
@stop
@section('css')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/btnFijo.css') }}">
    {{-- btn-fixed-width --}}

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.css" /> --}}

    {{-- DATATABLE --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css">
@endsection
@section('js')

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#productos', {
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


    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script> --}}
    <script>
        // var table = new DataTable('#productos', {
        //     language: {
        //         url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json",
        //     },
        // });

        // $(document).ready(function() {
        //     $('#productos').DataTable();
        // });
        $('#iptNombre').keyup(function() {

            table.column($(this).data('index')).search(this.value.toUpperCase()).draw();
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
