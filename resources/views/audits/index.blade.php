@extends('adminlte::page')

@section('title', 'Auditoria')

@section('content_header')
    <h1>Auditoria</h1>
@stop

@section('content')
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
                        <th>User Agent</th>
                        <th>Created At</th>
                        <th>Updated At</th> --}}
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

                            </tr>

                            <!-- Modal for Audit Details -->
                            <div class="modal fade" id="auditDetailsModal{{ $audit->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="auditDetailsModalLabel{{ $audit->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="auditDetailsModalLabel{{ $audit->id }}">Audit
                                                Details
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- Dentro del modal-body -->
                                        <div class="modal-body">
                                            <strong>Old Values:</strong> {{ json_encode($audit->old_values) }}<br>
                                            <strong>New Values:</strong> {{ json_encode($audit->new_values) }}<br>
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
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#auditsTable').DataTable({
                "paging": true,
                "searching": true
                // Add other options as needed
            });
        });
    </script>
@endsection
