@extends('adminlte::page')
@section('title')
@section('content_header')
    <h1>Generación de sku</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
            {{-- <a href="{{ route('detalleproducto.show', $producto->id) }}" class="btn btn-primary">Fabricacion producto</a> --}}
        </div>
        <div class="card-body">
            <p>Existen varios formatos para la generación de un SKU,
                cada uno diseñado para diferentes necesidades de categorización y seguimiento de productos.
                Estos formatos ofrecen flexibilidad para adaptar el SKU a diferentes contextos de inventario y gestión de
                productos.</p>
            <ul>
                <li> El <strong>Formato 1</strong> utiliza una combinación de categoría, material, color, año e ID del producto para crear un
                    identificador único.</li>
                <li>El <strong>Formato 2</strong> se basa en el nombre del producto, la marca, el tamaño y un número de lote, proporcionando
                    una estructura que facilita el reconocimiento del producto.</li>
                <li>El <strong>Formato 3</strong> emplea un esquema personalizado adaptado a necesidades específicas del
                    negocio. CATEGORIA-DIMENSIONES-AUTOR-ID</li>
                <li>El <strong>Formato 4 </strong>incluye la categoría, el nombre del producto y un número de lote, lo que
                    permite una identificación rápida pero efectiva.</li>
            </ul>
            <p>Nota informativa: <span>En caso de faltar algún campo para generar el SKU, se le asignará un valor por defecto. 
                Por defecto, se genera el Formato 4.</span></p>

            <form action="{{ route('storeSku') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="categoria mb-3">
                    <label for="" class="form-label">Tipo de SKU</label>

                    <select class="form-select" id="selector-sku" data-placeholder="Seleccione un tipo de sku"
                        name="tipo" required>
                        <option></option>

                        <option value="A">Formato 1</option>
                        <option value="B">Formato 2</option>
                        <option value="C">Formato 3</option>
                        <option value="D">Formato 4</option>
                    </select>

                </div>
                <button type="submit" class="btn btn-primary">Generar SKU</button>
            </form>

        </div>
    </div>

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
        $('#selector-sku').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
@endsection
