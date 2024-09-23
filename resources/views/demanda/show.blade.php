@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Detalle de Orden de compra</h1>
@stop

@section('content')
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
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
            @if ($demanda->estado != 'confirmado')
                @if (count($demanda->demandaProveedor) != 0)
                    <a href="{{ route('confirmar', ['id' => $demanda->id]) }}" class="btn btn-primary">Confirmar solicitud de
                        compra</a>
                @endif

                <a href="{{ route('registrodemandasproveedores.show', $demanda->id) }}" class="btn btn-primary">Asociar
                    proveedores</a>
            @endif

            {{-- validar --}}
            {{-- <a href="{{route('asignacion',)}}" class="btn btn-primary">Asignacion de materiales </a> --}}
        </div>
        <div class="card-body">
            {{-- <td>{{ $demanda->created_at->format('d-m-Y') }}</td>
            <td>{{ $demanda->fecha_cierre->format('d-m-Y') }}</td> --}}
            <div class="form-group">
                <label for="">Número de Orden</label>
                <input type="text" name="" id="" class="form-control" value="{{ $demanda->id }}"
                    readonly>
            </div>
            <div class="form-group">
                <label for="">Fecha de creación</label>
                <input type="text" name="" id="" class="form-control"
                    value="{{ $demanda->created_at->format('d-m-Y') }}" readonly>
            </div>

            <div class="form-group">
                <label for="">Fecha de cierre</label>
                <input type="text" name="" id="" class="form-control"
                    value="{{ $demanda->fecha_cierre }}" readonly>
            </div>
            <?php $estados = ['en-confirmacion' => 'En confirmacion', 'confirmado' => 'Confirmado', 'rechazado' => 'Rechazado'];
            $estado = array_key_exists($demanda->estado, $estados) ? $estados[$demanda->estado] : $demanda->estado;
            ?>
            <div class="form-group">
                <label for="">Estado actual</label>
                <input type="text" name="" id="" class="form-control" value="{{ $estado }}"
                    readonly>

            </div>
            <hr>
            <h3>Materiales solcitados</h3>
            <br>
            <table class="table table-striped table-bordered" id="demandas">
                <thead>
                    <tr>
                        <th>Nombre del material</th>
                        <th>Cantidad solicitada</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($demanda->detalleDemandas as $item)
                        <tr>
                            <td>{{ $item->material->nombre }}</td>
                            <td>{{ $item->cantidad }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <br>

    <div class="card">
        <div class="card-body">
            <h3> Proveedores asociados a la orden de compra</h3>
            <table class="table table-striped table-bordered" id="proveedores">
                <thead>
                    <tr>
                        <th>Nombre de empresa</th>
                        <th>Nombre del contacto proveedor</th>
                        <th>Telefono</th>
                        <th>Correo electronico</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($demanda->demandaProveedor as $reg)
                        <tr>
                            <td>{{ $reg->proveedor->nombre_empresa }}</td>
                            <td>{{ $reg->proveedor->nombre_contacto }}</td>
                            <td>{{ $reg->proveedor->telefono }}</td>
                            <td>{{ $reg->proveedor->correo }}</td>
                            <td width="10px">
                                @if ($demanda->estado != 'confirmado')
                                    <form action="{{ route('registrodemandasproveedores.destroy', $reg->id) }}"
                                        method="post" class="formulario-eliminar">
                                        @csrf
                                        @method('delete')
                                        <button id="tuBotonId" class="btn btn-danger btn btn-sm btn-fixed-width"
                                            type="submit">Borrar</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3>Ofertas de proveedores</h3>

            <table class="table table-striped table-bordered" id="ofertas">
                <thead>
                    <tr>
                        <th>Nombre de contacto del proveedor</th>
                        <th>Nro de oferta</th>
                        <th>Estado de la oferta</th>
                        <th>Fecha de entrega</th>
                        <th></th>
                        <th></th>
                        {{-- <th></th> --}}
                    </tr>
                </thead>
                <tbody>

                    @foreach ($ofertas as $oferta)
                        <tr>
                            <td>{{ $oferta->proveedor->nombre_contacto }}</td>
                            <td>{{ $oferta->id }}</td>
                            <td>{{ $oferta->estado }}</td>
                            <td>{{ $oferta->fecha_entrega }}</td>
                            <td><a href="{{ route('detalleoferta.show', $oferta->id) }}">Ver oferta</a></td>
                            <td><a href="{{ route('recepcion', $oferta->id) }}">Entrada de materiales</a></td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>


@stop
@section('css')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
    {{-- DATATABLE --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css">

@endsection
@section('js')
    {{-- 
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script> --}}


    {{-- DATATABLE --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#demandas', {
            language: {
                info: 'Mostrar registros de _START_ a _END_ ',
                infoEmpty: 'No hay registros',
                infoFiltered: '(filtrado de _MAX_ registros totales)',
                lengthMenu: 'Mostrar _MENU_ registros',
                zeroRecords: 'No se encontraron coincidencias',
                search: 'Buscar:',

                emptyTable: 'No hay datos disponibles',
            }
        });
    </script>


    <script>
        new DataTable('#proveedores', {
            language: {
                info: 'Mostrar registros de _START_ a _END_ ',
                infoEmpty: 'No hay registros',
                infoFiltered: '(filtrado de _MAX_ registros totales)',
                lengthMenu: 'Mostrar _MENU_ registros',
                zeroRecords: 'No se encontraron coincidencias',
                search: 'Buscar:',

                emptyTable: 'No hay datos disponibles',
            }
        });
    </script>

    <script>
        new DataTable('#ofertas', {
            language: {
                info: 'Mostrar registros de _START_ a _END_ ',
                infoEmpty: 'No hay registros',
                infoFiltered: '(filtrado de _MAX_ registros totales)',
                lengthMenu: 'Mostrar _MENU_ registros',
                zeroRecords: 'No se encontraron coincidencias',
                search: 'Buscar:',

                emptyTable: 'No hay datos disponibles',
            }
        });
    </script>

@endsection
