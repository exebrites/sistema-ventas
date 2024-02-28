@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Material</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">


            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Código Interno</th>
                        <th>Stock</th>
                        <th>Fecha Adquisición</th>
                        <th>Fecha Vencimiento</th>
                        <th>Precio Compra</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $material->id }}</td>
                        <td>{{ $material->nombre }}</td>
                        <td>{{ $material->descripcion }}</td>
                        <td>{{ $material->cod_interno }}</td>
                        <td>{{ $material->stock }}</td>
                        <td>{{ $material->fecha_adquisicion }}</td>
                        <td>{{ $material->fecha_vencimiento }}</td>
                        <td>{{ $material->precio_compra }}</td>

                    </tr>
                </tbody>
            </table>
            <a href="{{ route('proveedores.show', 1) }}">Ver proveedor</a>
        </div>
    </div>
@stop
