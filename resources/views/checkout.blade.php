@extends('layouts.app')

@section('content')
    @if ($estado == null)
        {{ $estado = 1 }};
    @endif

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
                    @switch($estado)
                        @case(1)
                            {{-- <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Tu estado de pedido es el siguiente : Pendiente de pago</h3>
                                    </div>
                                    <div class="card-body">
                                        <small>El estado "pendiente de pago" significa que tu pedido esta a la espera a que
                                            subas el comprobante de pago y que sea confirmado por la gerencia para asi seguir
                                            con los proximos pasos </small><br>
                                        <br>
                                        <p>Se envió un mensaje a tu correo electrónico para que puedas realizar el pago del
                                            pedido</p>
                                        <form action="{{ route('comprobantes.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <b><label>Subir comprobante</label></b>
                                                <br>
                                                <p>No te olvides de subir tu comprobante para reflejar tu pago en el sistema
                                                </p>

                                                <input type="file" class="form-control-file" name="comprobante" accept="image/*">
                                            </div>

                                            <input type="hidden" name="estado" value="{{ $estado }}" id="">
                                            <input type="hidden" name="id" value="{{ $id }}" id="">

                                            <button type="submit" class="btn btn-primary">Enviar comprobante</button>
                                        </form>

                                    </div>
                                </div>

                            </div> --}}

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

                                            <div class="form-group">
                                                <b><label for="comprobante">Subir comprobante</label></b>
                                                <p>No olvides subir tu comprobante para reflejar tu pago en el sistema.</p>
                                                <input type="file" class="form-control-file" name="comprobante" id="comprobante"
                                                    accept="image/*">
                                            </div>

                                            <input type="hidden" name="estado" value="{{ $estado }}" id="">
                                            <input type="hidden" name="id" value="{{ $id }}" id="">

                                            <button type="submit" class="btn btn-primary">Enviar comprobante</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @break

                        @case(2)
                            {{-- <div class="col">
                                <div class="card">
                                    <h5>Tu estado de pedido es el siguiente : Pago confirmado</h3>
                                        <div class="card-body">
                                            <small>El estado "Pago confirmado" significa que el pago fue confirmado y que ahora
                                                necesitas completar los siguientes campos para que sepamos donde entregar el pedido
                                            </small><br>
                                            <br>
                                            <h5>Datos de entrega</h5>

                                            <form action="{{ route('entrega.store') }}" method="POST">
                                                @csrf
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" name="local" id="miCheckbox"
                                                        checked>
                                                    <label class="form-check-label">Retiro en local</label>
                                                </div>
                                                <div id="div1">
                                                    <div class="form-group">
                                                        <label>Dirección del lugar de entrega</label>
                                                        <input type="text" class="form-control" name="direccion">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Telefono de contacto</label>
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

                                                <input type="hidden" name="estado" value="{{ $estado }}" id="">
                                                <input type="hidden" name="id" value="{{ $id }}" id="">


                                                <button type="submit" class="btn btn-primary">Finalizar pedido</button>
                                            </form>

                                        </div>
                                </div>
                            </div> --}}
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
                                                <input type="checkbox" class="form-check-input" name="local" id="miCheckbox"
                                                    checked>
                                                <label class="form-check-label">Retiro en local</label>
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

                                            <input type="hidden" name="estado" value="{{ $estado }}" id="">
                                            <input type="hidden" name="id" value="{{ $id }}" id="">

                                            <button type="submit" class="btn btn-primary">Finalizar pedido</button>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            {{-- <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Datos de facturacion</h5>

                                        <form>
                                            <div class="form-group">
                                                <label>Nombre y Apellido</label>
                                                <input type="email" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Numero de documento</label>
                                                <input type="email" class="form-control">
                                            </div>
                                            <small>Costo de producto $$$</small>
                                            <br>
                                            <small>Costo de envio $$$</small>
                                            <br>
                                            <br>
                                            <small>Costo total $$$</< /small>

                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-primary">Enviar datos para
                                                    facturacion</button>
                                        </form>

                                    </div>
                                </div>
                            </div> --}}
                        @break

                        @case(9)
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
                                    </div>
                                </div>
                            </div>
                        @break

                        @default
                            <small>El estado de "Inicio" significa que tu pedido esta se comenzó a trabajar y pronto
                                tendras noticias de nosotros para seguir con las siguientes etapas </small><br>
                            <br>
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
