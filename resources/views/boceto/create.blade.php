@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">

@section('content')
    <br><br>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">


            <div class="card">
                <div class="card-body">

                    @if (session()->has('success_msg'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success_msg') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    <h1>Realizar un boceto</h1>
                    <form action="{{ route('cart.store_boceto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                        <input type="hidden" value="{{ $pro->name }}" id="name" name="name">
                        <input type="hidden" value="{{ $pro->price }}" id="price" name="price">
                        <input type="hidden" value="{{ $pro->image_path }}" id="img" name="img_path">
                        <input type="hidden" value="{{ $pro->slug }}" id="slug" name="slug">
                        <input type="hidden" value="1" id="quantity" name="quantity">
                        <input type="hidden" name="disenio_estado" id="" value="false">

                        <div class="form-group">
                            <label><b>(*)Nombre del negocio</b></label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" name="nombre"
                                placeholder="Ej: empresaSA">
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <b><label>(*)Para que quiere el diseño?</label></b>
                            <input type="text" class="form-control" aria-describedby="emailHelp" name="objetivo"
                                placeholder="Ej: llegar a nuevos clientes">
                            @error('objetivo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <b> <label>(*)A quien va dirigido el diseño</label>
                            </b>
                            <input type="text" class="form-control" aria-describedby="emailHelp" name="publico"
                                placeholder="Ej: personas entre 18 30 años">
                            @error('publico')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <b><label>(*)Agregar contenido y texto</label></b>
                            <textarea class="form-control" aria-label="With textarea" name="contenido"></textarea>
                            @error('contenido')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <b><label>Agregar logotipo y elementos de la marca</label></b>
                            <input type="file" class="form-control-file" accept=".jpg, .jpeg, .png" name="logo">
                            @error('logo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            {{-- <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="check">
                                <label class="form-check-label" for="exampleCheck1">No tengo logotipo ni elementos de
                                    marca</label>
                            </div> --}}
                        </div>

                        <div class="form-group">
                            <b><label>Agregar imagenes y recursos visuales</label></b>

                            <input type="file" class="form-control-file" name="img" accept=".jpg, .jpeg, .png">
                            @error('img')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <br><br>

                        <div class="container ">
                            <div class="row">
                                <div class="col d-flex">

                                    <div id="btn-cancelar">
                                        <a href="" class="btn btn-danger btn-ampliado">Cancelar</a>
                                    </div>


                                    <div>
                                        <button type="submit" class="btn btn-primary btn-ampliado">Enviar</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



        </div>
        <div class="col-2">+



        </div>

    </div>

    <script>
        function manejarCambioArchivo() {
            var archivoInput = document.getElementById('archivoInput');
            var checkbox = document.getElementById('checkbox');

            // Verificar si se ha seleccionado un archivo
            if (archivoInput.files.length > 0) {
                // Desactivar el checkbox si se selecciona un archivo
                // checkbox.disabled = true;
                checkbox.style.display = "none";
            } else {
                // Habilitar el checkbox si no se selecciona ningún archivo
                // checkbox.disabled = false;
                checkbox.style.display = "block";
            }
        }
    </script>
@endsection
