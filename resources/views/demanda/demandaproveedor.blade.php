@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Asociar proveedor</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            <div class="form-group">

                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre de empresa</th>
                            <th>Nombre del contacto proveedor</th>
                            <th>Telefono</th>
                            <th>Correo electronico</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($proveedores as $proveedor)
                            <tr>
                                <td>{{ $proveedor->nombre_empresa }}</td>
                                <td>{{ $proveedor->nombre_contacto }}</td>
                                <td>{{ $proveedor->telefono }}</td>
                                <td>{{ $proveedor->correo }}</td>
                                <td><a href="{{ route('confirmacion_proveedor_orden_compra', ['proveedor_id' => $proveedor->id,'demanda_id'=> $demanda->id]) }}">Solicitud de
                                        confirmación</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <form action="{{ route('registrodemandasproveedores.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="demanda_id" value="{{ $demanda->id }}">

                    <label for="">Proveedores</label>
                    <select class="form-control js-example-basic-multiple" name="proveedores[]" id=""
                        multiple="multiple">
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre_contacto }}</option>
                        @endforeach
                    </select>

                    <br>
                    <br>

                    <div class="container ">
                        <div class="row">
                            <div class="col d-flex">

                                <div id="btn-cancelar">
                                    <a href="{{ route('demandas.index') }}" class="btn btn-danger btn-ampliado">Cancelar</a>
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
    </div>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
