@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Detalle producto</h1>
@stop

@section('content')
     
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
            <a href="{{ route('detalleproducto.create') }}" class="btn btn-primary">Crear detalle</a>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="">Nombre del producto</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ $producto->nombre }}" readonly>
            </div>
            <hr>
            @if ($producto->detalleProducto->count() > 0)
                <table class="table table-striped table-bordered" id="materiales">

                    <thead>
                        <tr>
                            <th>Nombre de empresa</th>
                            <th>Nombre del proveedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($producto->detalleProducto as $detalle)
                            <tr>
                                <td>{{ $detalle->proveedores->nombre_empresa }}</td>
                                <td>{{ $detalle->proveedores->nombre_contacto }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No tiene asignado proveedores</p>
            @endif
        </div>
    </div>
@endsection
@section('css')
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

@endsection
