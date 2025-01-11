@extends('adminlte::page')
@section('title')
@section('content_header')
    <h1>Pedidos</h1>
@stop
@section('content')
    <div class="card">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card-body">
            <h5> Criterios de busqueda
            </h5><br>
            <div class="row">
                <div class="col d-flex">
                    <div style="width: 30%" class="mx-2">
                        <label for="">Estado</label>
                        <select id="sltEstado" class="form-control">
                            <option value="">Todos</option>
                            <option value="pendiente">En confirmación de imprenta</option>
                            <option value="despachado">Pendiente de pago</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered" id="pedidos">
                <thead>
                    <tr>
                        <th>Nro de pedido</th>
                        <th>Estado</th>
                        <th>Costo total</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td id="1">{{ $pedido->estado->descripcion }}</td>
                            <td>$ {{ $pedido->costo_total }}</td>
                            <td width="10px"><a class="btn btn-warning btn btn-sm btn-fixed-width"
                                    href="{{ route('pedidos.edit', $pedido->id) }}">Editar</a></td>
                            <td><a href="{{ Route('pedidos.show', $pedido->id) }}"
                                    class="btn btn-secondary btn btn-sm btn-fixed-width">Ver mas</a></td>
                        </tr>
                        <div class="modal fade" id="exampleModal{{ $pedido->cliente->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Dni:{{ $pedido->cliente->dni }}</h5>
                                        <h5>Nombre:{{ $pedido->cliente->nombre }}</h5>
                                        <h5>Apellido:{{ $pedido->cliente->apellido }}</h5>
                                        <h5>Telefono:{{ $pedido->cliente->telefono }}</h5>
                                        <h5>Correo:{{ $pedido->cliente->correo }}</h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
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
    <link rel="stylesheet" href="{{ asset('css/btnFijo.css') }}">
@endsection
@section('js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
    <script>
        var table = new DataTable('#pedidos', {
            language: {
                info: 'Mostrar registros de _START_ a _END_ ',
                infoEmpty: 'No hay registros',
                infoFiltered: '(filtrado de _MAX_ registros totales)',
                lengthMenu: 'Mostrar _MENU_ registros',
                zeroRecords: 'No se encontraron coincidencias',
                search: 'Buscar:',
                emptyTable: 'No hay datos disponibles',
            },
            "order": [
                [5, "asc"],

            ],
        });
        $('#sltEstado').change(function() {
            var estado = $(this).val();
            // table.column(1).search(estado).draw();
            if (estado == "") {
                location.reload();
            } else {

                table.column(1).search('^' + estado + '$', true, false).draw();
            }
        });
    </script>

@endsection
