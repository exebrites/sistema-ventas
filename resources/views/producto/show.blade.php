@extends('adminlte::page')
@section('title')
@section('content_header')
    <h1>Detalle producto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
            <a href="{{ route('detalleproducto.show', $producto->id) }}" class="btn btn-primary">Proveedor del producto</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row justify-content-center align-items-center g-2">
                <div class="col">
                    <div class="form-group" style="display:none">
                        <label>identificador</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp" value="{{ $producto->id }}"
                            name="id" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                            value="{{ $producto->nombre }}" name="name" readonly>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Descripcion</label>
                        <input type="text" class="form-control" id="description" value="{{ $producto->descripcion }}"
                            name="description" readonly>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Precio</label>
                        <input type="number" class="form-control" name="price" required min="0" max="100000"
                            placeholder="Ej: 10000" step="0.01" value="{{ $producto->precio }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Stock</label>
                        <input type="number" class="form-control" name="stock" required min="0" max="100000"
                            placeholder="Ej: 10000" step="0.01" value="{{ $producto->stock }}" readonly>
                    </div>


                    <div class="mb-3">
                        <label for="" class="form-label">Categoria</label>
                        <input type="text" name="" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $producto->categoria->titulo }}" readonly />

                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">SKU</label>
                        <input type="text" name="sku" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $producto->sku }}" readonly />

                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Material</label>
                        <input type="text" name="material" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $producto->material }}" readonly />
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col">
                    
                    <div class="form-group">
                        <label for="" class="form-label">Color</label>
                        <input type="text" name="color" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $producto->color }}" readonly />
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Año de publicación</label>
                        <input type="number" name="anio_publicacion" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $producto->anio_publicacion }}" readonly />
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label">Marca</label>
                        <input type="text" name="marca" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $producto->marca }}" readonly />
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Tamaño</label>
                        <input type="text" name="tamanio" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $producto->tamanio }}" readonly />
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label">Dimensiones</label>
                        <input type="text" name="dimensiones" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $producto->dimensiones }}" readonly />
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Autor</label>
                        <input type="text" name="autor" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $producto->autor }}" readonly />
                    </div>

                </div>

            </div>
            <div class="container text-center">
                <h2>Imagen del producto</h2>
                <p>{{ $producto->nombre }}</p>
                <img src="{{ $producto->imagen }}" alt="Descripción de la imagen" class="img-fluid">
            </div>

        </div>
    </div>

@stop
