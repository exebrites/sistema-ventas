@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Pagina de historial de materiales</h1>
@stop

@section('content')

    {{-- {{ dd($mp) }} --}}
    <div class="card">
        <div class="card-header">
            {{-- Agregar --}}
            {{-- <a href="{{ route('materiales.create') }}" class="btn btn-success">Agregar nuevo material</a> --}}
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        {{-- <th>ID</th> --}}
                 

                        <th>cod material</th>
                        <th>precio actual</th>
                        <th>precio actualizado</th>
                        <th>Fecha de registro</th>
                        <th>Nombre del proveedor</th>
                        {{-- <th>telefono de contacto</th>
                        <th>correo electronico</th> --}}

                        {{-- <th colspan="2"></th> --}}
                    </tr>

                </thead>
                <tbody>

                    @foreach ($mp as $item)
                        {{-- {{ dd($item) }} --}}
                        <tr>
                            {{-- <td>{{ $item->id }}</td> --}}


                           
                            <td>{{ $item->material->cod_interno }}</td>

                            <td>{{ $item->precio_actual }}</td>
                            <td>{{ $item->precio_actualizado }}</td>
                            {{-- <td>{{ $item->created_at->format('Y-m-d')}}</td> --}}
                            <td>{{ $item->created_at}}</td>

                            <td>{{ $item->proveedor->nombre_empresa }}</td>
                            {{-- <td>{{ $item->proveedor->telefono }}</td>
                            <td>{{ $item->proveedor->correo }}</td> --}}

                            {{-- <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal{{ $item->id }}">
                                    ver mas </button>
                            </td> --}}

                            {{-- <td width="10px"><a class="btn btn-primary btn btn-sm"
                                    href="{{ route('materiales.edit', $item->id) }}">Editar</a></td>
                            <td width="10px">
                                <form action="{{ route('materiales.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn btn-sm" type="submit">borrar</button>
                                </form>
                            </td> --}}


                        </tr>

                        {{-- <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $item->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- --}}
                        {{-- <p>{{ $item->descripcion }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>  --}}
                        {{-- @endforeach --}}
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>


@stop
