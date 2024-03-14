@extends('layouts.app')

@section('content')
    {{-- @if ($estado == null)
        {{ $estado = 1 }};
    @endif --}}

    {{-- {{dd([$estado])}} --}}
    <div class="card">
        <div class="card-body">
            <br>
            <br>
            <div class="container">

                <br>
                @if (session('mensajeError'))
                    <div class="alert alert-danger">
                        {{ session('mensajeError') }}
                    </div>
                @endif
                <div class="row">
                    @switch($estado->id)
                        @case(2)
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Tu estado de pedido es el siguiente: Pendiente de pago</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            <small>
                                                El estado "Pendiente de pago" indica que tu pedido está a la espera de que subas el
                                                comprobante de pago,
                                                el cual será confirmado por la gerencia para continuar con los próximos pasos.
                                            </small>
                                        </p>
                                        <p>Se ha enviado un mensaje a tu correo electrónico con las instrucciones para realizar el
                                            pago del pedido.</p>

                                        <form action="{{ route('comprobantes.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="estado" value="{{ $estado->id }}">
                                            <input type="hidden" name="id" value="{{ $pedido->id }}">
                                            <div class="form-group">
                                                <b><label for="comprobante">Subir comprobante</label></b>
                                                <p>No olvides subir tu comprobante para reflejar tu pago en el sistema.</p>
                                                <input type="file" class="form-control-file" name="comprobante" id="comprobante"
                                                    accept="image/*">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Enviar comprobante</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @break

                        @case(3)
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Tu estado de pedido es el siguiente: Pago confirmado</h5>
                                        <p class="card-text">
                                            <small>
                                                El estado "Pago confirmado" indica que el pago ha sido confirmado. Ahora necesitas
                                                completar los siguientes campos para que sepamos dónde entregar el pedido.
                                            </small>
                                        </p>
                                        <h5>Datos de entrega</h5>
                                        <form action="{{ route('entrega.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" name="local" id="miCheckbox">
                                                <label class="form-check-label" for="miCheckbox">Retiro en local</label>
                                            </div>
                                            <div id="div1">
                                                <div class="form-group">
                                                    <label>Dirección del lugar de entrega</label>
                                                    <input type="text" class="form-control" name="direccion">
                                                </div>
                                                <div class="form-group">
                                                    <label>Teléfono de contacto</label>
                                                    <input type="text" class="form-control" name="telefono">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nombre de la persona que recibe</label>
                                                    <input type="text" class="form-control" name="nombre">
                                                </div>

                                                <div class="form-group">
                                                    <label>Nota</label>
                                                    <textarea class="form-control" aria-label="With textarea" name="nota">Sin comentarios</textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" name="estado" value="{{ $estado->id }}" id="">
                                            <input type="hidden" name="id" value="{{ $pedido->id }}" id="">
                                            <button type="submit" class="btn btn-primary">Finalizar pedido</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @break

                        @case(1)
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Estado de tu pedido: "En confirmación de impresión"</h5>
                                        <p class="card-text">
                                            <small>
                                                El estado "En confirmación de impresión" significa que la empresa está evaluando la
                                                fecha requerida.
                                                Te informaremos si es posible realizar el pedido para esa fecha o si se debe
                                                cambiar.
                                            </small>
                                        </p>
                                        <hr>
                                        <div class="form-group">
                                            <label for="">Numero de pedido</label>
                                            <input type="text" name="" id="" class="form-control" placeholder=""
                                                aria-describedby="helpId" value="{{ $pedido->id }}" readonly>
                                            {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="">Fecha requerida</label>
                                            <input type="text" name="" id="" class="form-control" placeholder=""
                                                aria-describedby="helpId" value="{{ $pedido->fecha_entrega }}" readonly>
                                            {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                                        </div>

                                        <div class="form-group">
                                            <label for="">Fecha propuesta por la empresa es:</label>

                                            @if ($pedido->fecha_inicio == null)
                                                <b>
                                                    <p>A la espera de una fecha propuesta</p>
                                                </b>
                                            @else
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="" aria-describedby="helpId" value="{{ $pedido->fecha_inicio }}"
                                                    readonly>
                                            @endif


                                        </div>

                                        <hr>
                                        {{-- {{dd($pedido->fecha_inicio )}} --}}
                                        @if ($pedido->fecha_inicio != null)
                                            <a href="{{ route('cancelarPedido', $pedido->id) }}"
                                                class="btn btn-danger">Cancelar</a>
                                            <a href="{{ route('confirmarPedido', $pedido->id) }}"
                                                class="btn btn-success">Confirmar</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @break

                        @default
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Tu estado de pedido es el siguiente: Inicio de proyecto</h5>
                                        <p class="card-text">
                                            <small>El estado de "Inicio" significa que tu pedido esta se comenzó a trabajar y pronto
                                                tendras noticias de nosotros para seguir con las siguientes etapas </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                    @endswitch
                </div>
            </div>

            <br>
            <br>

        </div>

    </div>


    <script>
        // Obtén una referencia al checkbox
        const checkbox = document.getElementById('miCheckbox');
        const div = document.getElementById('div1');

        // Agrega un evento de escucha al checkbox
        checkbox.addEventListener('click', function() {
            // Verifica si el checkbox está marcado
            if (checkbox.checked) {
                div.style.display = "none"
            } else {
                div.style.display = "block"
            }
        });
    </script>
    <script src="/js/app.js"></script>
@endsection
