@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">

@section('title')

@section('content_header')
    <h1>Agregar nuevo cliente</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
        
                </div>
        <div class="card-body">
            <form action="{{ route('clientes.store') }}" method="post" id="miFormulario">
                @csrf
                <div class="form-group">
                    <label>Numero del documento de identidad nacional (DNI)</label>

                    <input class="form-control" type="text" name="dni" required minlength="8" maxlength="8"
                        pattern="(\d{8})" placeholder="Ejemplo: 10000000" oninput="validarNumero(this)">
                    @error('dni')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" maxlength="255" placeholder="Ej: Pedro"
                        required>
                    @error('nombre')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" class="form-control" name="apellido" maxlength="255"placeholder="Ej: Martinez"
                        required>
                    @error('apellido')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Telefono</label>
                    <input type="tel" class="form-control" name="telefono" pattern="[0-9]{2,4}-[0-9]{6,8}"
                        placeholder="Ej: 3758-122331" required>
                    @error('telefono')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Correo electronico</label>
                    <input type="email" class="form-control" name="correo" placeholder="Ej: Pedro@gmail.com" required>
                    @error('correo')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>


                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="{{ route('clientes.index') }}" class="btn btn-danger btn-ampliado">Cancelar</a>
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

    <script>
      

        // También puedes realizar la validación en el evento submit del formulario
        document.getElementById('miFormulario').onsubmit = function() {
            var dniInput = document.getElementById('dni');
            validarNumero(dniInput);
            // Continuar con el envío del formulario si la validación es exitosa
            return /^\d{8}$/.test(dniInput.value);
        };
    </script>
@stop
