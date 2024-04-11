@extends('adminlte::page')

@section('title', 'Auditoria')

@section('content_header')
    <h1>Auditoria</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('filtroFecha') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="fdesde">Fecha desde </label>
                    <input type="date" name="fdesde" id="fdesde" class="form-control" value="">

                </div>


                <div class="form-group">
                    <label for="fhasta">Fecha hasta</label>
                    <input type="date" name="fhasta" id="fhasta" class="form-control">

                </div>
                {{-- <div class="form-group">
                    <label for="fhasta">Fecha hasta</label>
                    <select name="operacion" id="">
                        <option value="">Seleccionar</option>
                        <option value="created">Creación</option>
                        <option value="updated">Actualización</option>
                        <option value="deleted">Eliminación</option>
                    </select>
                </div> --}}
                <div class="form-group">
                    <label for="operacion" class="form-label">Operación</label>
                    <select name="operacion" id="operacion" class="form-select mb-3">
                        <option value="">Seleccionar</option>
                        <option value="created">Creación</option>
                        <option value="updated">Actualización</option>
                        <option value="deleted">Eliminación</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered" id="auditoria">
                <thead>
                    <tr>
                        {{-- <th>ID</th> --}}
                        <th>Tipo de Usuario</th>
                        <th>ID de Usuario</th>
                        <th>Evento</th>
                        <th>Tipo de Auditoría</th>
                        <th>Detalles</th>
                        {{-- <th>URL</th>
                        <th>IP Address</th>
                        <th>User Agent</th> --}}
                        <th>Creado en</th>
                        {{-- <th>Updated At</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if ($audits)
                        @foreach ($audits as $audit)
                            <tr>
                                {{-- <td>{{ $audit->id }}</td> --}}
                                <td>{{ $audit->user_type }}</td>
                                <td>{{ $audit->getName($audit->user_id) }}</td>

                                <td>{{ $audit->event }}</td>
                                <td>{{ $audit->auditable_type }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#auditDetailsModal{{ $audit->id }}">
                                        Ver Detalles
                                    </button>
                                </td>
                                <td>{{ $audit->created_at->format('d-m-Y') }}</td>

                            </tr>

                            <!-- Modal for Audit Details -->
                            <div class="modal fade" id="auditDetailsModal{{ $audit->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="auditDetailsModalLabel{{ $audit->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="auditDetailsModalLabel{{ $audit->id }}">Detalle de auditoria
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- Dentro del modal-body -->
                                        <div class="modal-body">
                                            <strong>Valores anteriores:</strong> {{ json_encode($audit->old_values) }}<br>
                                            <strong>Nuevos valores</strong> {{ json_encode($audit->new_values) }}<br>
                                            {{-- Include other details as needed --}}

                                            <!-- Añade estilos para limitar la altura y agregar desplazamiento -->
                                            <style>
                                                .modal-body {
                                                    max-height: 400px;
                                                    /* Ajusta la altura máxima según tus necesidades */
                                                    overflow-y: auto;
                                                    /* Agrega desplazamiento vertical si se excede la altura */
                                                }
                                            </style>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{ 'No hay registros' }}
                    @endif
                </tbody>
            </table>
        </div>

    </div>


@endsection




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
        var table = new DataTable('#auditoria', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
        // $('#iptAlias').keyup(function() {
        //     table.column($(this).data('index')).search(this.value).draw();
        // })

        // $('#iptNombre').keyup(function() {
        //     table.column($(this).data('index')).search(this.value).draw();
        // })

        // $('#iptDescripcion').keyup(function() {
        //     table.column($(this).data('index')).search(this.value).draw();
        // })

        // $('#iptNombre', '#iptDescripcion').keyup(function() {
        //     table.draw();
        // })

        // $.fn.dataTable.ext.search.push(
        //     function(settings, data, dataIndex) {
        //         var cosito = $('#iptNombre').val()
        //         console.log(cosito)
        //     }
        // )
    </script>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    {{-- implementacion de una confirmacion de borrado por el usuario --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/confirmacionBorrado.js') }}"></script>
@endsection
