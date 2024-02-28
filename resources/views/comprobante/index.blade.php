@extends('adminlte::page')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- Agrega estos enlaces en el head de tu HTML -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

@section('title')

@section('content_header')
    <h1>Listado de comprobante en estado pendiente-pago</h1>
@stop

@section('content')
    {{-- {{dd($comprobantes)}} --}}
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="comprobantes">
                <thead>
                    <tr>
                        <th>Fecha </th>
                        <th>Nro de comprobante</th>
                        <th>Nro de pedido</th>
                        <th>estado</th>
                        <th>comprobante</th>
                        

                    </tr>

                </thead>

                <tbody>

                    @foreach ($comprobantes as $item)
                        <tr>
                            {{-- x --}}
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->pedido->id }}</td>
                            <td>{{ $item->pedido->estado }}</td>
                            <td><a data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                                    Ver mas
                                </a></td>

                            {{-- display none cuando haga el primer click --}}




                            {{-- <td width="10px"><a class="btn btn-primary btn btn-sm"
                                    href="{{ route('disenios.edit', $item->id) }}">Editar</a>
                            </td> --}}
                            {{-- <td width="10px">
                                <form action="{{route('disenios.destroy',$item->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button  class="btn btn-danger btn btn-sm" type="submit">borrar</button>
                                </form>
                            </td>  --}}
                        </tr>


                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
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



                                        Muestra una imagen con
                                        <div class="row">
                                            <div class="col">
                                                <a href="{{ $item->url_comprobantes }}" class="image-popup" title="Zoom">
                                                    <img src="{{ $item->url_comprobantes }}" alt="Imagen 1"
                                                        class="img-fluid">
                                                </a>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
                                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach




                </tbody>
            </table>
        </div>
    </div>
    <script>
        // Agrega el siguiente script al final de tu archivo HTML o en una sección de scripts
        $(document).ready(function() {
            $('.image-popup').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'mfp-img-mobile',
                image: {
                    verticalFit: true
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#comprobantes');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
@stop
