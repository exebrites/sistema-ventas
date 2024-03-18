@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Detalle de demanda</h1>
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
                <a href="{{ route('confirmar', ['id' => $demanda->id]) }}" class="btn btn-primary">Confirmar solicitud de
                    compra</a>
                <a href="{{ route('registrodemandasproveedores.show', $demanda->id) }}" class="btn btn-primary">Asociar
                    proveedores</a>
            @endif
        </div>
        <div class="card-body">
            {{-- <td>{{ $demanda->created_at->format('d-m-Y') }}</td>
            <td>{{ $demanda->fecha_cierre->format('d-m-Y') }}</td> --}}
            <div class="form-group">
                <label for="">Numero de demanda</label>
                <input type="text" name="" id="" class="form-control" value="{{ $demanda->id }}"
                    readonly>
            </div>
            <div class="form-group">
                <label for="">Fecha de creacion</label>
                <input type="text" name="" id="" class="form-control"
                    value="{{ $demanda->created_at->format('d-m-Y') }}" readonly>
            </div>

            <div class="form-group">
                <label for="">Fecha de cierre</label>
                <input type="text" name="" id="" class="form-control"
                    value="{{ $demanda->fecha_cierre }}" readonly>
            </div>

            <div class="form-group">
                <label for="">Estado actual</label>
                <input type="text" name="" id="" class="form-control" value="{{ $demanda->estado }}"
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
                    </tr>
                </thead>
                <tbody>

                    @foreach ($demanda->demandaProveedor as $reg)
                        <tr>
                            <td>{{ $reg->proveedor->nombre_empresa }}</td>
                            <td>{{ $reg->proveedor->nombre_contacto }}</td>
                            <td>{{ $reg->proveedor->telefono }}</td>
                            <td>{{ $reg->proveedor->correo }}</td>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

@endsection
@section('js')

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        var table = new DataTable('#demandas', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    </script>


    <script>
        var table = new DataTable('#proveedores', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    </script>

    <script>
        var table = new DataTable('#ofertas', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    </script>
    
@endsection
