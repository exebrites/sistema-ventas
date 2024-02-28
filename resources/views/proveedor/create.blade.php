@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">

@section('title')

@section('content_header')
    <h1>Agregar nuevo proveedor</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
        
                </div>
        <div class="card-body">
            <form action="{{ route('proveedores.store') }}" method="post">
                @csrf


                <div class="form-group">
                    <label>Nombre empresa</label>
                    <input required type="text" class="form-control" name="empresa" placeholder="Ej: Libreria mayorista SA">
                    @error('empresa')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nombre contacto</label>
                    <input required type="text" class="form-control" name="nombre_contacto"
                        placeholder="Ej: Pedro pedrozo">
                    @error('nombre_contacto')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>CUIT</label>

                    <input required type="text" class="form-control" name="cuit" placeholder="Ej:20-12312123-3"
                        pattern= "[0-9]{2}-[0-9]{8}-[0-9]+">
                    @error('cuit')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label>Telefono</label>
                    <input required type="tel" class="form-control" name="telefono" pattern="[0-9]{2,4}-[0-9]{6,8}"
                        placeholder="Ej: 3758-122331" required>
                    @error('telefono')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>



                <div class="form-group">
                    <label>correo electronico</label>
                    <input required type="email" class="form-control" name="correo" placeholder="Ej: Pedro@gmail.com"
                        required>
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
                                <button type="submit" class="btn btn-success btn-ampliado">Agregar</button>
                            </div>

                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>
@stop
