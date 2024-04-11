@extends('layouts.app')

@section('content')
    <br>
    <br>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h1 style="text-align: center">Revisión de diseño</h1>
                @if ($disenio->revision == 0)

                    <div class="row">

                        @if ($disenio->detallePedido->pedidos->estado->nombre === 'disenio' && $disenio->url_disenio != '')
                            <div class="col-6">
                                <br>
                                <br>
                                <h2>Diseño de producto</h2> <br>

                                <h6>Nombre del producto: {{ $disenio->detallePedido->producto->name }}</h5>
                                    <div class="form-group">
                                        <label></label>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#imagenModal">
                                            Ver Imagen
                                        </button>
                                    </div>
                                    <br>
                                    <label>Diseño del producto</label>
                                    {{-- <img src="{{ $disenio->url_disenio }}" alt="Disenio del producto" srcset=""> --}}
                                    <img src="{{ $disenio->url_disenio }}" class="card-img-top img-fluid"
                                        alt="Diseño del producto">

                            </div>


                            <div class="col-6">
                                <div class="container mt-5">
                                    <h2>Encuesta de Diseño</h2>

                                    <input type="hidden" name="{{ $i = 1 }}">
                                    <form action="{{ route('respuestas.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" class="form-control" aria-describedby="textHelp"
                                            name="disenio_id" value="{{ $disenio->id }}" readonly>
                                        @foreach ($preguntas as $pregunta)
                                            @if ($pregunta->contenido == 'comentario')
                                                <div class="mb-3">
                                                    <label for="comentarios" class="form-label">Comentarios
                                                        adicionales:</label>
                                                    <textarea class="form-control" id="comentarios" value="Sin comentarios" name="comentario" rows="4" cols="50">Sin comentarios</textarea>
                                                </div>
                                            @elseif($pregunta->id == 5)
                                                <label for="">
                                                    {{ $i++ }}){{ $pregunta->contenido }}</label><br>
                                                {{-- <input type="text" name="{{ $pregunta->id }}" id=""
                                                class="form-control" placeholder="" aria-describedby="helpId"
                                                value="sin respuesta"> --}}
                                                <select name="{{ $pregunta->id }}" id="pregunta_{{ $pregunta->id }}"
                                                    class="form-control" required>
                                                    <option value="" selected>Selecciona una opción
                                                    </option>
                                                    <option value="Muy bueno">(1) Muy bueno</option>
                                                    <option value="Bueno">(2) Bueno</option>
                                                    <option value="Malo">(3) Malo</option>

                                                </select>
                                            @else
                                                <div class="form-group">
                                                    <label for="">
                                                        {{ $i++ }}){{ $pregunta->contenido }}</label><br>
                                                    {{-- <input type="text" name="{{ $pregunta->id }}" id=""
                                                        class="form-control" placeholder="" aria-describedby="helpId"
                                                        value="sin respuesta"> --}}
                                                    <select name="{{ $pregunta->id }}" id="pregunta_{{ $pregunta->id }}"
                                                        class="form-control"required>
                                                        <option value="" selected>Selecciona una opción
                                                        </option>
                                                        <option value="SI">Si</option>
                                                        <option value="No">No</option>

                                                    </select>

                                                </div>
                                            @endif
                                        @endforeach



                                        <small><b>Aclaracion:</b><br>Al momento de responder con un SI a la siguiente
                                            pregunta,
                                            nos da la confirmación para seguir con la siguiente etapa. En caso contrario
                                            (respuesta: NO) el diseño volverá a revisar y se le notificará para su revision
                                        </small>
                                        <div class="mb-3">
                                            <label for="pregunta3" class="form-label">¿Esta conforme con el diseño?</label>
                                            <select id="pregunta3" name="revision" class="form-control"required>
                                                <option value="" selected>Selecciona una opción
                                                </option>
                                                <option value="1">Sí</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>

                                        @if ($disenio->detallePedido->produccion == 0)
                                            <button type="submit" class="btn btn-primary">Enviar respuesta</button>
                                        @else
                                            <b style="color:green">Diseño aprobado</b>
                                        @endif
                                    </form>
                                </div>

                            </div>
                        @else
                            este producto no tiene diseño por el momento
                        @endif

                    </div>
                @else
                    <hr>
                    <br>
                    <h6>El diseño esta siendo revisado.
                        Nos comunicaremos pronto con usted
                    </h6>
                @endif
                <!-- Modal -->
                <div class="modal fade" id="imagenModal" tabindex="-1" role="dialog" aria-labelledby="imagenModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imagenModalLabel">Imagen del Diseño</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Imagen en el modal -->
                                <img src="{{ $disenio->url_imagen }}" class="img-fluid" alt="Imagen del diseño en grande">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
