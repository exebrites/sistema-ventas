@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">

@section('title')

@section('content_header')
    <h1>Agregar usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('usuarios.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="" placeholder="" name="name">
                    @error('name')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="text" class="form-control" id="" placeholder="" name="email">
                    @error('email')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Contreña</label>
                    <input type="text" class="form-control" id="" placeholder="" name="password">
                    @error('password')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                {{-- <div class="mb-3">
                    <label class="form-label">Tipo de usuario</label>
                    <input type="text" class="form-control" id="" placeholder="" name="tipo_usuario">
                </div> --}}
                <div class="mb-3">
                    <label class="form-label">Tipo de usuario</label>
                    <select class="form-control" name="tipo_usuario">
                        <option value="">Seleccionar tipo de usuario</option>
                        <option value="cliente">Cliente</option>
                        <option value="proveedor">Proveedor</option>
                        <option value="admin">Admin</option>
                        <option value="empleado">Empleado</option>
                        <option value="gerente">Gerente</option>
                    </select>
                    @error('tipo_usuario')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>



                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="{{ route('usuarios.index') }}" class="btn btn-danger btn-ampliado">Cancelar</a>
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
@stop
