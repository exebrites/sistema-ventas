@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Crear detalle de producto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
                <a href="{{ route('proveedores.create') }}" class="btn btn-primary">Crear Proveedor</a>
            </div>
            {{-- producto --}}
            <form action="{{ route('detalleproducto.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Nombre del producto </label>
                    <br>
                    <select class="form-select" name="producto_id" aria-label="Default select example">
                        <option selected>Seleccione un producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <hr>
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">Empresa</th>
                                <th scope="col">Nombre de proveedor</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proveedores as $proveedor)
                                <tr class="">
                                    <td>{{ $proveedor->nombre_empresa }}</td>
                                    <td>{{ $proveedor->nombre_contacto }}</td>
                                    <td><input type="checkbox" name="proveedores[]" value="{{ $proveedor->id }}"
                                            id=""></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button>Guardar</button>
            </form>
        </div>
    </div>
@stop
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
@endsection
