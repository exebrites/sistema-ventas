@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>
        materiales para oferta</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            <h5>Materiales solcitados</h5>
            <br>
            <table class="table table-striped table-bordered" id="demandas">
                <thead>
                    <tr>
                        <th>nombre</th>
                        <th>cantidad</th>


                        <th>acccion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($demanda->detalleDemandas as $item)
                        <tr>
                            <td>{{ $item->material->nombre }}</td>
                            <td>{{ $item->cantidad }}</td>


                            <td>
                                @if (!$oferta->finalizar_oferta)
                                    <a href="{{ route('detalleofertas.crear', ['demanda_id' => $demanda->id, 'oferta_id' => $oferta->id, 'material_id' => $item->material->id]) }}"
                                        class="btn btn-success" disabled>Agregar material</a>
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

            Aca el proveedor realiza su oferta y puede verla. Asi como modificar y borrar antes del cierre de oferta
            ofertas realizadas
            <table class="table table-striped table-bordered" id="detalles">
                <thead>
                    <tr>
                        <th>Nombre del material</th>
                        {{-- <th>Marca</th> --}}
                        <th>Cantidad</th>
                        <th>Precio</th>
                        {{-- <th>Fecha de entrega</th> --}}
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($oferta->detalleOferta as $detalle)
                        <tr>
                            <td>{{ $detalle->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>{{ $detalle->precio }}</td>

                            <td width="10px">
                                @if (!$oferta->finalizar_oferta)
                                    <a class="btn btn-warning btn btn-sm"
                                        href="{{ route('detalleoferta.edit', $detalle->id) }}"disabled>Editar</a>
                                @endif
                            </td>
                            <td width="10px">
                                @if (!$oferta->finalizar_oferta)
                                    <form action="{{ route('detalleoferta.destroy', $detalle->id) }}" method="post"
                                        class="formulario-eliminar">
                                        @csrf
                                        @method('delete')
                                        <button id="tuBotonId" class="btn btn-danger btn btn-sm "
                                            type="submit">borrar</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach





                </tbody>
            </table>

            <hr>
            <br><br>
            @if (count($oferta->detalleOferta) != 0)
                @if (!$oferta->finalizar_oferta)
                    <a href="{{ route('finalizar_oferta', $oferta->id) }}" class="btn btn-primary">finalizar oferta</a>
                @endif

            @endif
        </div>
    </div>
@endsection
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
            order: [
                [0, 'desc']
            ],
        });
    </script>
    <script>
        var table = new DataTable('#detalles', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
            order: [
                [0, 'desc']
            ],
        });
    </script>
@endsection
