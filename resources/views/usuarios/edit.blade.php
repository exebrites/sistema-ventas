@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Editar usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
                @csrf
                @method('put')

                <input type="hidden" class="form-control" id="" placeholder="" name="usuario_id"
                    value="{{ $usuario->id }}">
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="" placeholder="" name="name"
                        value="{{ $usuario->name }}">
                    @error('name')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="text" class="form-control" id="" placeholder="" name="email"
                        value="{{ $usuario->email }}">
                    @error('email')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>
                {{-- <div class="mb-3">
                    <label class="form-label">Contreña</label>
                    <input type="text" class="form-control" id="" placeholder="" name="password"
                        value="{{ $usuario->password }}">
                    @error('password')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div> --}}



                <div class="form-group">
                    <label for="tipo_usuario">tipo_usuario:</label>
                    <select class="form-control" id="tipo_usuario" name="tipo_usuario" required>
                        <option value="cliente" @if ($usuario->tipo_usuario == 'cliente') selected @endif>Cliente
                        </option>
                        <option value="proveedor" @if ($usuario->tipo_usuario == 'proveedor') selected @endif>proveedor
                        </option>
                        <option value="admin" @if ($usuario->tipo_usuario == 'admin') selected @endif>admin
                        </option>
                        <option value="empleado" @if ($usuario->tipo_usuario == 'empleado') selected @endif>empleado
                        </option>
                        <option value="gerente" @if ($usuario->tipo_usuario == 'gerente') selected @endif>gerente
                        </option>
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
@endsection

@section('css')

    <link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">

@endsection
