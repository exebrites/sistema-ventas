@extends('layouts.app')

@section('content')
    {{-- @success --}}
    {{-- {{$estado;}}  --}}
    {{-- @if (session()->has('success_msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success_msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif --}}
    @if ($estado == null)
        {{ $estado = 'pendiente-pago' }};
    @endif

    <div class="card">
        <div class="card-body">
            <br>
            <br>

            {{-- {{dd($error)}} --}}
            <div class="container">
                <h5>Tu estado de pedido es el siguiente : {{ $estado }}</h3>
                    <br>
                    @if (session('mensajeError'))
                        <div class="alert alert-danger">
                            {{ session('mensajeError') }}
                        </div>
                    @endif
                    <div class="row">

                        @switch($estado)
                            @case('pendiente-pago')
                                {{-- {{dd($estado)}} --}}

                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <small>El estado de {{ $estado }} significa que tu pedido esta a la espera a que
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

                                                    <input type="file" class="form-control-file" name="comprobante"
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

                            @case('confirmado-pago')
                                {{-- {{dd($estado)}} --}}
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <small>El estado de {{ $estado }} significa que el pago fue confirmado y que ahora
                                                necesitas completar los siguientes campos para que sepamos donde entregar el pedido
                                            </small><br>
                                            <br>
                                            <h5>Datos de entrega</h5>

                                            <form action="{{ route('entrega.store') }}" method="POST">
                                                @csrf
                                                {{-- <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" name="local"
                                                id="miCheckbox" checked>
                                            <label class="form-check-label" >Retiro en local</label>
                                        </div> --}}
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

                            @case('disenio')
                                {{-- {{    event(new App\Events\MiEvento())}} --}}
                                {{-- {{ $disenio = (new App\Http\Controllers\DisenioController())->show_disenio($id)
                            }}
                            <img src="{{$disenio->url_disenio}}" alt="" srcset=""> --}}
                                {{-- 
                            Que trae $id trae el valor del id pedido {{$id}}
                            traer por cada producto su diseño
                            que pasa si no tiene el diseño 
                            mostrar una vista dentro de otra vista --}}
                            @break

                            @default
                                <small>El estado de {{ $estado }} significa que tu pedido esta se comenzó a trabajar y pronto
                                    tendras noticias de nosotros para seguir con las siguientes etapas </small><br>
                                <br>
                        @endswitch








                    </div>
            </div>

            <br>
            <br>
            {{-- cuando se active este boton se debe de actualizar los campos del "pre-predido" --}}
            {{-- <a href="#" class="btn btn-success">Realizar pedido</a> --}}


            <div> <a class="btn btn-danger" href="{{ url()->previous() }}">Cancelar</a></div>

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
