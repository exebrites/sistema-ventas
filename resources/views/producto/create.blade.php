@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">

@section('title')

@section('content_header')
    <h1>Agregar nuevo producto</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
            {{-- <a href="{{route('detalleproducto.create')}}" class="btn btn-primary">Fabricacion</a> --}}

        </div>
        <div class="card-body">
            <form action="{{ route('productos.store') }}" method="post" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                        required placeholder="Ej: Almanaque Anillado">
                    @error('name')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Descripcion</label>
                    <input type="text" class="form-control" id="description" name="description"
                        value="{{ old('description') }}" required placeholder="Ej: Un texto descriptivo del producto">
                    @error('description')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>
                {{-- !! Agregar un alias o nomenclaruta !! --}}
                <div class="form-group">
                    <label>Alias</label>
                    <input type="text" class="form-control" name="alias" id="alias" value="{{ old('alias') }}"
                        required placeholder="Ej:AA12x14">
                    @error('alias')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Precio $</label>
                    <input type="number" class="form-control" name="price" value="{{ old('price') }}" required
                        min="0" max="100000" placeholder="Ej: 10000" step="0.01">
                    @error('price')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Seleccionar imagen</label>
                    <input class="form-control" type="file" id="formFile" name="file" accept="image/jpeg,png" required>
                    @error('file')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>
                <div class="categoria mb-3">
                    <label for="" class="form-label">(*)Categoria</label>

                    <select class="form-select" id="selector-categoria" data-placeholder="Seleccione una categoria"
                        name="categoria_id" required>
                        <option></option>

                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->titulo }}</option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>
               <div class="mb-3">
                <label for="" class="form-label">SKU</label>
                <input
                    type="text"
                    name="sku"
                    id=""
                    class="form-control"
                    placeholder=""
                    aria-describedby="helpId"
                />
               </div>
               


                <hr>
                <br>
                <br>
                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="{{ route('productos.index') }}" class="btn btn-danger btn-ampliado">Cancelar</a>
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
{{-- @section('js')
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    

@endsection --}}
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
