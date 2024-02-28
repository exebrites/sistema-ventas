@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Recepcion de materiales</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="">Nro de oferta</label>
                <input type="text" class="form-control" readonly value="{{ $oferta->id }}">

            </div>
            <hr>

            <form action="{{ route('entradaMateriales') }}" method="post">
                @csrf
                <table class="table table-striped table-bordered" id="ofertas">
                    <thead>
                        <tr>
                            <th>Material</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Entrada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($oferta->detalleOferta as $detalle)
                            <tr>


                                <input type="hidden" name="material_id[]" class="form-control" readonly
                                    value="{{ $detalle->material_id }}">


                                <td>

                                    <input type="text" name="nombre[]" class="form-control" readonly
                                        value="{{ $detalle->material->nombre }}">

                                </td>
                                <td>

                                    <input type="text" name="cantidad[]" class="form-control" readonly
                                        value="{{ $detalle->cantidad }}">

                                </td>
                                <td>

                                    <input type="text" name="precio[]" class="form-control" readonly
                                        value="{{ $detalle->precio }}">

                                </td>
                                <td>

                                    <input type="text" name="entrada[]" class="form-control" placeholder=""
                                        aria-describedby="helpId" value="{{ $detalle->cantidad }}">

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <br>
                <br>
                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="{{ route('demandas.index') }}" class="btn btn-danger btn-ampliado">Cancelar</a>
                            </div>


                            <div>
                                <button type="submit" class="btn btn-success btn-ampliado">Agregar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
@endsection
@section('js')

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var table = new DataTable('#ofertas', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
            order: [
                [0, 'desc']
            ],
        });
    </script>
@endsection
