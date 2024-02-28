@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">

@section('title')

@section('content_header')
    <h1>Editar producto</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">

            <div class="text-center">
                <img src="{{ $producto->image_path }}" class="rounded" alt="..." style="width: 300px; height: auto;">
            </div>
            <form action="{{ route('productos.update', $producto) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group" style="display:none">
                    <label>identificador</label>
                    <input type="text" class="form-control" aria-describedby="emailHelp" value="{{ $producto->id }}"
                        name="id" readonly>
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                        value="{{ $producto->name }}" name="name">
                    @error('name')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Descripcion</label>
                    <input type="text" class="form-control" id="description" value="{{ $producto->description }}"
                        name="description">
                    @error('description')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Alias</label>
                    <input type="text" class="form-control" name="alias" id="alias" value="{{ $producto->alias }}">
                    @error('alias')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Precio</label>
                    <input type="number" class="form-control" name="price" required min="0" max="100000"
                        placeholder="Ej: 10000" step="0.01" value="{{ $producto->price }}">
                    @error('price')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
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
