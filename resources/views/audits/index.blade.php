@extends('adminlte::page')

@section('title', 'Auditoria')

@section('content_header')
    <h1>Auditoria</h1>
@stop

@section('content')
    {{-- {{dd($audits[0])}} --}}
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
                        {{-- <th>Modelo</th> --}}

                        <th>Nombre de usuario</th>

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
                            {{-- {{dump($audit)}} --}}
                            @if (count($audit->old_values) === 1 && array_key_exists('visitas', $audit->old_values))
                                @continue
                            @endif
                            @if (array_key_exists('old_values', $audit->getAttributes()) &&
                                    array_key_exists('remember_token', $audit->old_values) &&
                                    array_key_exists('new_values', $audit->getAttributes()) &&
                                    array_key_exists('remember_token', $audit->new_values))
                                @continue
                            @endif
                            <tr>
                                {{-- <td>{{ $audit->id }}</td> --}}
                                {{-- <td>{{ $audit-> }}</td> --}}
                                {{-- <td>{{ $audit->user_type === 'App\Models\User' ? 'Usuario' : class_basename($audit->user_type) }}</td> --}}
                                <td>{{ $audit->getUserNameAttribute($audit->user_id) }}</td>

                                <td>
                                    @switch($audit->event)
                                        @case('created')
                                            Creación
                                        @break

                                        @case('updated')
                                            Actualización
                                        @break

                                        @case('deleted')
                                            Eliminación
                                        @break

                                        @default
                                            {{ $audit->event }}
                                    @endswitch
                                </td>
                                <td>{{ class_basename($audit->auditable_type) === 'User' ? 'Usuario' : class_basename($audit->auditable_type) }}
                                </td>
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
                                            <h5 class="modal-title" id="auditDetailsModalLabel{{ $audit->id }}">Detalle
                                                de auditoria
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- Dentro del modal-body -->
                                        <div class="modal-body">
                                            {{-- {{dd($audit->old_values)}} --}}

                                            {{-- {{ json_encode($audit->old_values) }}
                                            <br>
                                            {{ json_encode($audit->new_values) }}
                                            <br> --}}




                                            @if (strcmp($audit->auditable_type, 'App\Models\User') === 0)
                                                <strong>Valores anteriores:</strong>
                                                @if (empty($audit->old_values))
                                                    <p>No existen valores anteriores.</p>
                                                @else
                                                    @foreach ($audit->old_values as $key => $value)
                                                        <p><strong>{{ $key }}:</strong> {{ $value }}</p>
                                                    @endforeach
                                                @endif
                                                <strong>Nuevos valores:</strong><br>
                                                @foreach ($audit->new_values as $key => $value)
                                                    <p><strong>{{ $key }}:</strong> {{ $value }}</p>
                                                @endforeach
                                            @endif
                                            @if (strcmp($audit->auditable_type, 'App\Models\Cliente') === 0)
                                                <strong>Valores anteriores:</strong>
                                                @if (empty($audit->old_values))
                                                    <p>No existen valores anteriores.</p>
                                                @else
                                                    @foreach ($audit->old_values as $key => $value)
                                                        <p><strong>{{ $key }}:</strong> {{ $value }}</p>
                                                    @endforeach
                                                @endif
                                                <strong>Nuevos valores:</strong><br>
                                                @foreach ($audit->new_values as $key => $value)
                                                    <p><strong>{{ $key }}:</strong> {{ $value }}</p>
                                                @endforeach
                                            @endif
                                            @if (strcmp($audit->auditable_type, 'App\Models\Pedido') === 0)
                                                <strong>Valores anteriores:</strong>
                                                @if (empty($audit->old_values))
                                                    <p>No existen valores anteriores.</p>
                                                @else
                                                    @foreach ($audit->old_values as $key => $value)
                                                        {{-- <p><strong>{{ $key }}:</strong> {{ $value }}</p> --}}
                                                        @if ($key == 'estado_id')
                                                            <p><strong>{{ $key == 'estado_id' ? 'Estado' : $key }}:</strong>
                                                                {{ $audit->getEstadoNameAttribute($value) }}</p>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                <strong>Nuevos valores:</strong><br>
                                                @foreach ($audit->new_values as $key => $value)
                                                    {{-- <p><strong>{{ $key }}:</strong> {{ $value }}</p> --}}
                                                    @if ($key == 'estado_id')
                                                        <p><strong>{{ $key == 'estado_id' ? 'Estado' : $key }}:</strong>
                                                            {{ $audit->getEstadoNameAttribute($value) }}</p>
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if (strcmp($audit->auditable_type, 'App\Models\Disenio') === 0)
                                                <strong>Valores anteriores:</strong>
                                                @if (empty($audit->old_values))
                                                    <p>No existen valores anteriores.</p>
                                                @else
                                                    @foreach ($audit->old_values as $key => $value)
                                                        <p><strong>{{ $key }}:</strong> {{ $value }}</p>
                                                    @endforeach
                                                @endif
                                                <strong>Nuevos valores:</strong><br>
                                                @foreach ($audit->new_values as $key => $value)
                                                    <p><strong>{{ $key }}:</strong> {{ $value }}</p>
                                                @endforeach
                                            @endif
                                            @if (strcmp($audit->auditable_type, 'App\Models\Producto') === 0)
                                                <strong>Valores anteriores:</strong>
                                                @if (empty($audit->old_values))
                                                    <p>No existen valores anteriores.</p>
                                                @else
                                                    @foreach ($audit->old_values as $key => $value)
                                                        {{-- <p><strong>{{ $key }}:</strong> {{ $value }}</p> --}}
                                                        <ul>
                                                            @if ($key === 'name')
                                                                <li>Nombre: {{ $value }}</li>
                                                            @endif
                                                            @if ($key === 'price')
                                                                <li>Precio: ${{ $value }}</li>
                                                            @endif
                                                            @if ($key === 'description')
                                                                <li>Descripción: {{ $value }}</li>
                                                            @endif
                                                            @if ($key === 'slug')
                                                                <li>Slug: {{ $value }}</li>
                                                            @endif
                                                            @if ($key === 'image_path')
                                                                <li>Imagen: {{ $value }}</li>
                                                            @endif
                                                            @if ($key === 'category_id')
                                                                <li>Categoría:
                                                                    {{ $audit->getTituloCategoriaAttribute($value) }}</li>
                                                            @endif
                                                        </ul>
                                                    @endforeach
                                                @endif
                                                <strong>Nuevos valores:</strong><br>
                                                @foreach ($audit->new_values as $key => $value)
                                                    {{-- <p><strong>{{ $key }}:</strong> {{ $value }}</p> --}}
                                                    <ul>
                                                        @if ($key === 'name')
                                                            <li>Nombre: {{ $value }}</li>
                                                        @endif
                                                        @if ($key === 'price')
                                                            <li>Precio: ${{ $value }}</li>
                                                        @endif
                                                        @if ($key === 'description')
                                                            <li>Descripción: {{ $value }}</li>
                                                        @endif
                                                        @if ($key === 'slug')
                                                            <li>Slug: {{ $value }}</li>
                                                        @endif
                                                        @if ($key === 'image_path')
                                                            <li>Imagen: {{ $value }}</li>
                                                        @endif
                                                        @if ($key === 'category_id')
                                                            <li>Categoría:
                                                                {{ $audit->getTituloCategoriaAttribute($value) }}</li>
                                                        @endif
                                                    </ul>
                                                @endforeach
                                            @endif
                                            @if (strcmp($audit->auditable_type, 'App\Models\Demanda') === 0)
                                                <strong>Valores anteriores:</strong>
                                                @if (empty($audit->old_values))
                                                    <p>No existen valores anteriores.</p>
                                                @else
                                                    @foreach ($audit->old_values as $key => $value)
                                                        <p><strong>{{ $key }}:</strong> {{ $value }}</p>
                                                    @endforeach
                                                @endif
                                                <strong>Nuevos valores:</strong><br>
                                                @foreach ($audit->new_values as $key => $value)
                                                    <p><strong>{{ $key }}:</strong> {{ $value }}</p>
                                                @endforeach
                                            @endif
                                            @if (strcmp($audit->auditable_type, 'App\Models\Oferta') === 0)
                                                <strong>Valores anteriores:</strong>
                                                @if (empty($audit->old_values))
                                                    <p>No existen valores anteriores.</p>
                                                @else
                                                    @foreach ($audit->old_values as $key => $value)
                                                        <p><strong>{{ $key }}:</strong> {{ $value }}</p>
                                                        {{-- @if (array_key_exists('finalizar_oferta', $audit->old_values))
                                                            <p><strong>Finalizar oferta:</strong>
                                                                {{ $audit->old_values['finalizar_oferta'] === 0 ? 'NO' : 'SI' }}
                                                            </p>
                                                        @endif --}}
                                                    @endforeach
                                                @endif
                                                <strong>Nuevos valores:</strong><br>
                                                @foreach ($audit->new_values as $key => $value)
                                                    <p><strong>{{ $key }}:</strong> {{ $value }}</p>
                                                    {{-- <p><strong>Finalizar oferta:</strong>
                                                        {{ $audit->old_values['finalizar_oferta'] === 0 ? 'NO' : 'SI' }}
                                                    </p> --}}
                                                    {{-- @if (array_key_exists('finalizar_oferta', $audit->old_values))
                                                        <p><strong>Finalizar oferta:</strong>
                                                            {{ $audit->old_new_valuesvalues['finalizar_oferta'] === 0 ? 'NO' : 'SI' }}
                                                        </p>
                                                    @endif --}}
                                                @endforeach
                                            @endif
                                            @if (strcmp($audit->auditable_type, 'App\Models\Material') === 0)
                                                <strong>Valores anteriores:</strong>
                                                @if (empty($audit->old_values))
                                                    <p>No existen valores anteriores.</p>
                                                @else
                                                    @foreach ($audit->old_values as $key => $value)
                                                        <p><strong>{{ $key }}:</strong> {{ $value }}</p>
                                                    @endforeach
                                                @endif
                                                <strong>Nuevos valores:</strong><br>
                                                @foreach ($audit->new_values as $key => $value)
                                                    <p><strong>{{ $key }}:</strong> {{ $value }}</p>
                                                @endforeach
                                            @endif
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- --- --}}
    <link rel="stylesheet" href="{{ asset('css/btnFijo.css') }}">
    {{-- btn-fixed-width --}}

    {{-- DATATABLE --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css">

@endsection
@section('js')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    {{-- DATATABLE --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#auditoria', {
            language: {
                info: 'Mostrar registros de _START_ a _END_ ',
                infoEmpty: 'No hay registros',
                infoFiltered: '(filtered from _MAX_ total records)',
                lengthMenu: 'Mostrar _MENU_ registros',
                zeroRecords: 'No se encontraron coincidencias',
                search: 'Buscar:',

                emptyTable: 'No hay datos disponibles',
            },
            order: [12, 'asc'],
        });
    </script>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    {{-- implementacion de una confirmacion de borrado por el usuario --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/confirmacionBorrado.js') }}"></script>
@endsection
