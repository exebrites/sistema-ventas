@extends('layouts.app')

@section('content')
    <br>
    <br>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h1 style="text-align: center">Revision de diseño</h1>
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
                                            Ver Imagen del diseño
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
                                            @else
                                                <div class="form-group">
                                                    <label for="">
                                                        {{ $i++ }}){{ $pregunta->contenido }}</label><br>
                                                    <input type="text" name="{{ $pregunta->id }}" id=""
                                                        class="form-control" placeholder="" aria-describedby="helpId"
                                                        value="sin respuesta">

                                                </div>
                                            @endif
                                        @endforeach
                                        {{-- <div class="form-group" style="">

                                      
                                    </div>


                                    <div class="mb-3">
                                        <label for="pregunta1" class="form-label">1) ¿Te gusta el diseño?</label>
                                        <select class="form-select" id="pregunta1" name="1">
                                            <option value="si">Sí</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="pregunta2" class="form-label">2) ¿Son los colores solicitados?</label>
                                        <select class="form-select" id="pregunta2" name="2">
                                            <option value="si">Sí</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="pregunta3" class="form-label">3) ¿Lo escrito en el diseño es lo
                                            solicitado?</label>
                                        <select class="form-select" id="pregunta3" name="3">
                                            <option value="si">Sí</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="calificacion" class="form-label">Calificación del diseño (1-3) <br>
                                            Siendo 1) Excelente 2)
                                            Bueno 3) Malo:</label>
                                        <input type="number" class="form-control" id="calificacion" name="4"
                                            min="1" max="3" required>
                                    </div>
                                    

                                    --}}
                                        <small><b>Aclaracion:</b><br>Al momento de responder con un SI la siguiente
                                            pregunta,
                                            nos da la confirmacion para pasar a produccion. En caso contrario (respuesta:
                                            NO) el
                                            diseño volverá a revisar y se le notificará para su revision </small>
                                        <div class="mb-3">
                                            <label for="pregunta3" class="form-label">¿Esta conforme con el diseño?</label>
                                            <select class="form-select" id="pregunta3" name="revision">
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
