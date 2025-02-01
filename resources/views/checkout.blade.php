@extends('layouts.app')

@section('content')
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    {{-- {{dd($pedido)}} --}}
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
                                            <input type="text" class="form-control" name="direccion" value="">
                                            @error('direccion')
                                                <br>
                                                <small style="color:red">{{ $message }}</small>
                                            @enderror

                                        </div>
                                        <label>Telefono de contacto</label>
                                        <input type="tel" class="form-control" name="telefono"
                                            placeholder="Ej: 3758-122331">
                                        @error('telefono')
                                            <br>
                                            <small style="color:red">{{ $message }}</small>
                                        @enderror
                                        <div class="form-group">
                                            <label>Nombre de la persona que recibe</label>
                                            <input type="text" class="form-control" name="nombre">
                                            @error('nombre')
                                                <br>
                                                <small style="color:red">{{ $message }}</small>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label>Nota</label>
                                            <textarea class="form-control" aria-label="With textarea" name="nota">Sin comentarios</textarea>

                                        </div>
                                    </div>
                                    <input type="hidden" name="estado" value="{{ $estado->id }}" id="">
                                    <input type="hidden" name="id" value="{{ $pedido->id }}" id="">
                                    {{-- <button type="submit" id="checkout-btn" class="btn btn-primary">Finalizar
                                        pedido</button> --}}
                                    <button type="submit" id="checkout-btn" class="btn btn-primary">Finalizar
                                        pedido</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

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
