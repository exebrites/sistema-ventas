@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Proveedor</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">


            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Empresa</th>
                        <th>Nombre Contacto</th>
                        <th>CUIT</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $proveedor->id }}</td>
                        <td>{{ $proveedor->nombre_empresa }}</td>
                        <td>{{ $proveedor->nombre_contacto }}</td>
                        <td>{{ $proveedor->cuit }}</td>
                        <td>{{ $proveedor->telefono }}</td>
                        <td>{{ $proveedor->correo }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
