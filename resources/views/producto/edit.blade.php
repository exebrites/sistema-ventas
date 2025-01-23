@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">

@section('title')

@section('content_header')
    <h1>Editar producto</h1>
@stop

@section('content')
    {{-- {{dd($producto)}} --}}
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            {{-- <div class="text-center">
                <img src="{{ $producto->imagen }}" class="rounded" alt="..." style="width: 300px; height: auto;">
            </div> --}}
            <form action="{{ route('productos.update', $producto) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">
                        <div class="form-group" style="display:none">
                            <label>identificador</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp"
                                value="{{ $producto->id }}" name="id" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                                value="{{ $producto->nombre }}" name="name">
                            @error('nombre')
                                <br>
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Descripcion</label>
                            <input type="text" class="form-control" id="description" value="{{ $producto->descripcion }}"
                                name="description">
                            @error('descripcion')
                                <br>
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label>Alias</label>
                            <input type="text" class="form-control" name="alias" id="alias"
                                value="{{ $producto->alias }}">
                            @error('alias')
                                <br>
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Precio</label>
                            <input type="number" class="form-control" name="price" required min="0" max="100000"
                                placeholder="Ej: 10000" step="0.01" value="{{ $producto->precio }}">
                            @error('precio')
                                <br>
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Stock</label>
                            <input type="number" class="form-control" name="stock" required min="0" max="100000"
                                placeholder="Ej: 10000" step="0.01" value="{{ $producto->stock }}">
                            @error('stock')
                                <br>
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="" class="form-label">(*)Categoria</label>

                            <select class="form-select" id="selector-categoria" data-placeholder="Seleccione una categoria"
                                name="categoria_id" required>
                                <option></option>

                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ $categoria->id === $producto->category_id ? 'selected' : '' }}>
                                        {{ $categoria->titulo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categoria_id')
                                <br>
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">SKU</label>
                            <input type="text" name="sku" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ $producto->sku }}" />
                            @error('sku')
                                <br>
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Material</label>
                            <input type="text" name="material" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ $producto->material }}" />
                        </div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col">

                        <div class="form-group">
                            <label for="" class="form-label">Color</label>
                            <input type="text" name="color" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ $producto->color }}" />
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Año de publicación</label>
                            <input type="number" name="anio_publicacion" id="" class="form-control"
                                placeholder="" aria-describedby="helpId" value="{{ $producto->anio_publicacion }}" />
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Marca</label>
                            <input type="text" name="marca" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ $producto->marca }}" />
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Tamaño</label>
                            <input type="text" name="tamanio" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ $producto->tamanio }}" />
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Dimensiones</label>
                            <input type="text" name="dimensiones" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ $producto->dimensiones }}" />
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Autor</label>
                            <input type="text" name="autor" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ $producto->autor }}" />
                        </div>

                    </div>

                </div>
                <div class="form-group">
                    <label>Seleccionar imagen</label>
                    <input type="file" class="form-control-file" name="file"accept="image/jpeg,png">
                    @error('file')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>


                <br>
                <br>
                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="{{ route('productos.index') }}" class="btn btn-danger btn-ampliado">Cancelar</a>
                            </div>


                            <div style="">
                                <button type="submit" class="btn btn-success btn-ampliado">Actualizar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>

        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <!-- Script para generar el Alias en tiempo real -->
        <script>
            $(document).ready(function() {
                // Evento keyup en los campos Nombre y Descripción
                $('#name, #description').on('keyup', function() {
                    // Obtén el valor de los campos Nombre y Descripción
                    var nombre = $('#name').val().toLowerCase();
                    var descripcion = $('#description').val().toLowerCase();


                    // Dividir la cadena en palabras
                    const palabras = nombre.split(" ");

                    // Obtener la primera letra de cada palabra y convertirla a mayúsculas
                    const primerasLetras = palabras.map(palabra => palabra.charAt(0).toUpperCase());

                    // Unir las letras en una cadena
                    var alias = primerasLetras.join("");

                    // Reemplaza espacios con guiones bajos
                    descripcion = descripcion.replace(/\s+/g, '_');

                    // Combina el nombre y la descripción para formar el alias
                    alias = alias + '_' + descripcion;

                    // Asigna el valor del alias al campo correspondiente
                    $('#alias').val(alias);
                });
            });
        </script>
    @stop
    @section('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <!-- Or for RTL support -->
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    @endsection
    @section('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
        <script>
            $('#selector-categoria').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
            });
            $('#selector-proveedor').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
            });
        </script>
    @stop
