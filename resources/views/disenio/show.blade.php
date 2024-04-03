@extends('adminlte::page')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@section('title')

@section('content_header')
    <h1>Detalle de diseño</h1>
@stop

@section('content')
    <h1 style="color:red">Validar la subir diseño</h1>

    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">

            Estado del diseño: @if ($disenio->revision === 0)
                @if ($disenio->detallePedido->produccion === 0)
                    <b style="color:green">Diseño enviado al cliente</b>
                @else
                    <b style="color:green">Diseño Aprobado</b>
                @endif
            @else
                <b style="color:red">Realizar revisión del diseño </b>
            @endif
            <hr>
            <div class="row-6">
                <h4> Informacion adicional</h4>
                {{-- <br> /**Diseño para tal producto que va incluido en tal pedido para tal fecha* --}}
                <br>
                <div class="card mb-3  mx-auto" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $disenio->detallePedido->producto->image_path }}" class="img-fluid rounded-start"
                                alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body text-center">
                                <b>Producto:</b> {{ $disenio->detallePedido->producto->name }} <br>

                                <b>Número de pedido :</b> {{ $disenio->detallePedido->pedido_id }} <br>
                                {{-- Fecha de entrega : {{ $disenio->detallePedido->pedido->fecha_entrega }} --}}
                                <b>Fecha de entrega :</b>
                                {{-- {{ dd($fecha_inicio)    }} --}}
                                @if ($disenio->detallePedido->pedidos->fecha_inicio != null)
                                    {{ $fecha_inicio }}
                                @else
                                    {{ 'No tiene asignada una fecha de entrega' }}
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <h4>Informacion del diseño y acciones </h4>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-6">

                        {{-- <form action="{{ route('descargar_boceto') }}" method="post">
                            @csrf
                            <input type="hidden" name="archivo" value="url_logo">
                            <input type="hidden" name="id" value={{ $boceto->id }}>
                            <br>
                            <button type="submit" class="btn btn-primary">Descargar</button>
                        </form> --}}
                        <b> Diseño original del cliente : </b>
                        <br>
                        {{-- Estado del disenio : {{ $disenio->disenio_estado ? 'tiene disenio' : 'no tiene diseño ' }} --}}
                        {{-- <img src="{{ $disenio->url_imagen }}" class="img-fluid " alt="..."> --}}

                        <br>
                        @if ($disenio->url_imagen != null)
                            <div class="card mb-3">
                                <img src="{{ $disenio->url_imagen }}" class="card-img-top fixed-size" alt="...">
                                <div class="card-body d-flex justify-content-between">
                                    <form action="{{ route('disenios_descargar') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="archivo" value="url_imagen">
                                        <input type="hidden" name="id" value={{ $disenio->id }}>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Descargar</button>
                                    </form>



                                </div>
                            </div>
                        @endif



                    </div>

                    <div class="col-6">

                        {{-- <form action="{{ route('descargar_boceto') }}" method="post">
                            @csrf
                            <input type="hidden" name="archivo" value="url_img">
                            <input type="hidden" name="id" value={{ $boceto->id }}>
                            <br>
                            <button type="submit" class="btn btn-primary">Descargar</button>
                        </form> --}}
                        <br>
                        <b> Diseño actual:</b>
                        <br>
                        @if ($disenio->url_disenio == null)
                            actualmente no tiene diseño
                        @else
                            <div class="card mb-3">
                                <img src="{{ $disenio->url_disenio }}" class="card-img-top fixed-size" alt="...">
                                <div class="card-body d-flex justify-content-between">

                                    <form action="{{ route('disenios_descargar') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="archivo" value="url_disenio">
                                        <input type="hidden" name="id" value={{ $disenio->id }}>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Descargar</button>
                                    </form>
                                    <br>
                                    @if ($disenio->revision === 1)
                                        <form action="{{ route('actualizar_disenio', $disenio) }}" method="post"
                                            class="formulario-eliminar">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="borrar" value="1">
                                            <input type="hidden" name="id" value="{{ $disenio->id }}">
                                            <br>
                                            <button id="tuBotonId" class="btn btn-danger" type="submit">Borrar
                                                diseño</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <br>

                    </div>
                </div>
            </div>
            <div class="row-6">



                @if ($disenio->revision === 1)
                    <form action="{{ route('actualizar_disenio', $disenio) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $disenio->id }}">
                        <input type="hidden" name="borrar" value="0">
                        {{-- <div class="form-group">
        <label for="file">Seleccionar archivo:</label>
        <input type="file" class="form-control-file" name="file" id="file" accept="image/png"
            required>
    </div> --}}
                        <div class="mb-3">
                            <label for="formFile" class="form-label"> <b>Subir imagen</b></label>
                            <input class="form-control" type="file" id="formFile" name="file" accept="image/png">
                        </div>

                        <button type="submit" class="btn btn-success">Subir diseño</button>
                    </form>
                @endif



                <hr>


                <br>
                <hr>

                @foreach ($disenio->respuesta as $respuesta)
                    <h1>Pregunta:{{ $respuesta->pregunta->contenido }} <br>Respuesta
                        {{ $respuesta->contenido_respuesta }}</h1><br>
                @endforeach
            </div>





            <hr>




            <div class="container ">
                <div class="row">
                    <div class="col d-flex">

                        <div id="btn-cancelar">
                            <a href="{{ route('pedidos.show', $disenio->detallePedido->pedido_id) }}"
                                class="btn btn-danger btn-ampliado">Cancelar</a>
                        </div>
                        {{-- {{ dd( $disenio->revision == 0) }} --}}
                        @if ($disenio->url_disenio == null || $disenio->revision == 0)
                            <div>
                                <a class="btn btn-default btn-ampliado" aria-disabled="true">Enviar a revision</a>
                            </div>
                        @endif
                        @if ($disenio->url_disenio != null && $disenio->revision == 1)
                            <div>
                                <a href="{{ route('revision_disenio', $disenio->id) }}"
                                    class="btn btn-primary btn-ampliado">Enviar a revision</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
    <style>
        .fixed-size {
            width: 550px;
            /* Tamaño fijo en píxeles */
            height: 400px;
            /* Tamaño fijo en píxeles */
        }
    </style>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
@endsection
