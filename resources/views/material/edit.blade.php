@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
@section('title')

@section('content_header')
    <h1>Editar material</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
        
                </div>
        <div class="card-body">
            <form action="{{ route('materiales.update', $material) }}" method="post">
                @csrf
                @method('PUT')

                <input type="hidden" class="form-control" name="id" value="{{ $material->id }}" readonly>


                <div class="form-group">
                    <label>*Nombre</label>

                    <input type="text" class="form-control" name="nombre" placeholder="Ej:pigmento azul"
                        value="{{ $material->nombre }}" required maxlength="255">
                    @error('nombre')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Descripcion</label>
                    <textarea class="form-control" name="descripcion" rows="5" value="{{ $material->descripcion }}">Sin comentarios</textarea>
                    @error('descripcion')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>*Codigo interno</label>
                    <input type="text" class="form-control" name="cod" required maxlength="50"
                        value="{{ $material->cod_interno }}" placeholder="Ej:PA">
                    @error('cod')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>



                <div class="form-group">
                    <label>Cantidad en stock</label>
                    <input type="number" class="form-control" name="stock" value="{{ $material->stock }}"
                        placeholder="19" pattern="[0-9]" min="1">
                    @error('stock')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>






                <div class="form-group">
                    <label>*Fecha de adquisicion</label>
                    <input type="date" class="form-control" name="f_adquisicion" required
                        value="{{ $material->fecha_adquisicion }}">
                    @error('f_adquisicion')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label>Fecha de vencimiento</label>
                    <input type="date" class="form-control" name="f_vencimiento"
                        value="{{ $material->fecha_vencimiento }}">
                    @error('f_vencimiento')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>*Precio $</label>
                    <input type="number" class="form-control" name="precio_compra" value="{{ $material->precio_compra }}"
                        required min="0" max="100000" placeholder="Ej: 10000" step="0.01">
                    @error('precio_compra')
                        <br>
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="{{ route('materiales.index') }}" class="btn btn-danger btn-ampliado">Cancelar</a>
                            </div>


                            <div>
                                <button type="submit" class="btn btn-success btn-ampliado">Actualizar</button>                            </div>

                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>
@stop
