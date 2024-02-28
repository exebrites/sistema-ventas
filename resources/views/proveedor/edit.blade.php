@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">

@section('title')

@section('content_header')
    <h1>Editar proveedor</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
        
                </div>
        <div class="card-body">
            <form action="{{ route('proveedores.update', $proveedor) }}" method="post">
                @csrf
                @method('put')
                <input type="hidden" class="form-control" name="id" value="{{ $proveedor->id }}" readonly>

                <div class="form-group">
                    <label>Nombre empresa</label>
                    <input type="text" class="form-control" name="empresa" value="{{ $proveedor->nombre_empresa }}"
                        placeholder="Ej: Libreria mayorista SA">
                    @error('empresa')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nombre contacto</label>
                    <input type="text" class="form-control" name="nombre_contacto"
                        value="{{ $proveedor->nombre_contacto }}" placeholder="Ej: Pedro pedrozo">
                    @error('nombre_contacto')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>CUIT</label>

                    <input required type="text" class="form-control" name="cuit" placeholder="Ej:20-12312123-3"
                        pattern= "[0-9]{2}-[0-9]{8}-[0-9]+" value="{{ $proveedor->cuit }}">
                    @error('cuit')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Telefono</label>
                    <input required type="tel" class="form-control" name="telefono" pattern="[0-9]{2,4}-[0-9]{6,8}"
                        placeholder="Ej: 3758-122331" value="{{ $proveedor->telefono }}">
                    @error('telefono')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>correo electronico</label>
                    <input type="email" class="form-control" name="correo" placeholder="Ej: Pedro@gmail.com" required
                        value="{{ $proveedor->correo }}">
                    @error('correo')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="{{ route('proveedores.index') }}" class="btn btn-danger btn-ampliado">Cancelar</a>
                            </div>



                            <div>
                                <button type="submit" class="btn btn-success btn-ampliado">Actualizar</button>
                            </div>

                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>
@stop
