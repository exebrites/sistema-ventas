@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>prueba </h1>
@stop
{{-- {{ dd($pedido) }} --}}

@section('content')
    {{-- {{ $estadosSecuenciales = ['en_confirmacion_imprenta', 'pendiente_pago', 'confirmado_pago', 'inicio', 'disenio', 'pre_produccion', 'produccion', 'terminado', 'entregado', 'cancelado'] }} --}}
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="estado_id">Actualizar estado del pedido</label>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select class="form-control" id="estado" name="estado" required>
                        @if ($pedido->estado->nombre == 'en_confirmacion_imprenta')
                            <option value="en_confirmacion_imprenta" @if ($pedido->estado_id == 1) selected @endif>En
                                confirmacion de imprenta
                            </option>
                            <option value="cancelado">Cancelado</option>
                            <option value="pendiente_pago">Pendiente de pago</option>
                        @elseif($pedido->estado->nombre == 'pendiente_pago')
                            <option value="pendiente_pago" @if ($pedido->estado_id == 2) selected @endif>
                                Pendiente de pago
                            </option>
                            <option value="cancelado">Cancelado</option>
                            <option value="confirmacion_pago">Confirmacion pago</option>
                        @elseif($pedido->estado->nombre == 'confirmacion_pago')
                            <option value="confirmacion_pago" @if ($pedido->estado_id == 3) selected @endif>
                                confirmacion de pago
                            </option>
                            <option value="cancelado">Cancelado</option>
                            <option value="inicio">inicio de proyecto</option>
                        @elseif($pedido->estado->nombre == 'inicio')
                            <option value="inicio" @if ($pedido->estado_id == 4) selected @endif>
                                inicio
                            </option>
                            <option value="cancelado">Cancelado</option>
                            <option value="disenio">diseño</option>
                        @elseif($pedido->estado->nombre == 'disenio')
                            <option value="disenio" @if ($pedido->estado_id == 5) selected @endif>
                                Diseño
                            </option>
                            <option value="cancelado">Cancelado</option>
                            <option value="pre_produccion">Pre produccion</option>
                        @endif



                    </select>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <!-- Agrega un botón con el tooltip personalizado -->
            <div class="custom-tooltip">
              <span>(?)</span>
              <div class="tooltip-content">¡Hola! Soy un tooltip personalizado</div>
            </div>
          </div>

        <script>
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    @endsection
    @section('css')
        <style>
            .custom-tooltip {
                position: relative;
                display: inline-block;
                cursor: pointer;
            }

            .custom-tooltip .tooltip-content {
                visibility: hidden;
                background-color: #ffffff;
                /* Fondo blanco */
                color: #000000;
                /* Texto negro */
                border: 2px solid #000000;
                /* Contorno negro */
                border-radius: 10px;
                /* Borde redondeado */
                padding: 10px;
                /* Espaciado interno */
                position: absolute;
                z-index: 1;
                bottom: 125%;
                left: 50%;
                transform: translateX(-50%);
                transition: opacity 0.3s;
                opacity: 0;
            }

            .custom-tooltip .tooltip-content::after {
                content: "";
                position: absolute;
                top: 100%;
                left: 50%;
                margin-left: -5px;
                border-width: 5px;
                border-style: solid;
                border-color: #000000 transparent transparent transparent;
            }

            .custom-tooltip:hover .tooltip-content {
                visibility: visible;
                opacity: 1;
            }
        </style>
    @endsection
