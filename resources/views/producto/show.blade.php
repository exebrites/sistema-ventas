@extends('adminlte::page')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
@section('title')

@section('content_header')
    <h1>Detalle producto</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
        
                </div>
        <div class="card-body">

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Producto con sus materiales para la construccion
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="card mx-auto" style="width: 18rem;">
                                <img src="{{ $producto->image_path }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <p class="card-text">
                                        <b>Nombre:</b>{{ $producto->name }} <br>
                                        <b>Descripcion:</b> {{ $producto->description }}<br>
                                        <b>Alias:</b>{{ $producto->alias }} <br>
                                    </p>
                                </div>
                            </div>
                            {{-- <a class="btn btn-secondary"
                                href="{{ route('materiales_necesarios', $producto->id) }}">Materiales en stock</a> --}}
                            <br>
                            <br>
                            <hr>

                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Agregar materiales
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <h5>Materiales utilizados para la fabricacion</h5>

                            <br>
                            <table id="" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($producto->detalleproducto as $item)
                                        <tr>
                                            <td>{{ $item->materiales->nombre }}</td>
                                            <td>{{ $item->cantidad }}</td>

                                            <td width="10px"><a class="btn btn-primary btn btn-sm"
                                                    href="{{ route('detalleproducto.editar', ['producto_id' => $item->producto_id, 'material_id' => $item->material_id]) }}">Editar</a>
                                            </td>
                                            <td width="10px">
                                                <form
                                                    action="{{ route('detalleproducto.eliminar', ['producto_id' => $item->producto_id, 'material_id' => $item->material_id]) }}"
                                                    method="post" class="formulario-eliminar">
                                                    @csrf
                                                    @method('delete')
                                                    <button id="tuBotonId" class="btn btn-danger btn btn-sm "
                                                        type="submit">borrar</button>
                                                </form>
                                            </td>
                                            <td><a href="{{ route('materiales.show', $item->materiales->id) }}">Ver
                                                    material</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <h2> Materiales disponibles</h2> <br>
                            <form action="{{ route('detalleproducto.store') }}" method="post">
                                @csrf
                                <table class="table table-striped" id="materiales">
                                    <thead>
                                        <tr>

                                            <th>Nombre</th>
                                            <th>Ingresa cantidad</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($materiales as $item)
                                            <tr>
                                                <td>{{ $item->nombre }}</td>

                                                <td>
                                                    <input type="text" name="cantidades[{{ $item->id }}]"
                                                        id="">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">



                                <div class="container ">
                                    <div class="row">
                                        <div class="col d-flex">

                                            <div id="btn-cancelar">
                                                <a href="{{ route('productos.index') }}"
                                                    class="btn btn-danger btn-ampliado">Cancelar</a>
                                            </div>


                                            <div>
                                                <button type="submit" class="btn btn-primary btn-ampliado">Agregar
                                                    materiales al detalle</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                {{-- <div class="accordion-item">
                    <h2 class="accordion-header" id="heading3">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                          Proveedores
                        </button>
                    </h2>
                    <div id="collapse3" class="accordion-collapse collapse show" aria-labelledby="heading3"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                        </div>
                    </div>
                </div> --}}
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var table = new DataTable('#materiales', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
@stop
