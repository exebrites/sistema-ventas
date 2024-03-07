@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
@section('title')

@section('content_header')
    <h1>Agregar presupuesto</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <form class="form" action="{{ route('presupuestos.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="clientes">Clientes:</label>
                    {{-- <select name="cliente" id="permissions" class="form-control  js-example-basic-multiple"
                        multiple="multiple">
                      
                    </select> --}}
                    <select class="js-example-basic-single" name="cliente_id">
                        {{-- <option value="AL">Alabama</option>
                        ...
                        <option value="WY">Wyoming</option> --}}
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre . ' ' . $cliente->apellido. ' ' . $cliente->dni }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Fecha de cierre</label>
                    <input type="date" name="fecha_entrega" id="" class="form-control" placeholder=""
                        aria-describedby="helpId">

                </div>
                {{-- <div class="mb-3">
                    <label class="form-label">Tiempo vigente del presupuesto</label>
                    <input type="text" class="form-control" name="tiempo_presupuesto">
                </div> --}}
                {{-- <div class="mb-3">
                    <label class="form-label">Tipo de proyecto</label>
                    <input type="text" class="form-control" name="tipo_proyecto">
                </div> --}}
                {{-- <div class="mb-3">
                    <label class="form-label">Maximo de revisiones</label>
                    <input type="text" class="form-control" name="max_revision">
                </div> --}}
                {{-- <div class="mb-3">
                    <label class="form-label">Clasulas</label>
                    <input type="text" class="form-control" name="clausula">
                </div> --}}
                {{-- <div class="mb-3">
                    <label class="form-label">Forma de pago</label>
                    <input type="text" class="form-control" name="forma_pago">
                </div> --}}
                {{-- <div class="input-group">
                    <span class="input-group-text">Producto</span>
                    <input type="text" class="form-control" name="producto">
                    <span class="input-group-text">Cantidad</span>
                    <input type="text" class="form-control" name="cantidad_producto">
                </div> --}}
                {{-- <div class="form-group">
                  <label for="">Producto</label>
                  <input type="text" name="producto" id="" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-muted">Help text</small>
                </div>
                <div class="form-group">
                    <label for=""></label>
                    <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Help text</small>
                  </div> --}}
                <br>
                {{-- <div class="input-group">
                    <span class="input-group-text">Material</span>
                    <input type="text" class="form-control" name="material">
                    <span class="input-group-text">Cantidad</span>
                    <input type="text" class="form-control" name="cantidad_material">
                </div> --}}

                {{-- <hr>
                etapas
                <div class="mb-3">
                    <label class="form-label">Diseño</label>
                    <input type="text" class="form-control" name="disenio">
                </div>
                <div class="mb-3">
                    <label class="form-label">Imprenta</label>
                    <input type="text" class="form-control" name="imprenta">
                </div>
                <div class="mb-3">
                    <label class="form-label">Subtotal</label>
                    <input type="text" class="form-control" name="subtotal">
                </div>
                <hr>
                otros gastos
                <div class="mb-3">
                    <label class="form-label">Gestion</label>
                    <input type="text" class="form-control" name="gestion">
                </div>
                <div class="mb-3">
                    <label class="form-label">Viatico</label>
                    <input type="text" class="form-control" name="viatico">
                </div>
                <div class="mb-3">
                    <label class="form-label">Costo de pago</label>
                    <input type="text" class="form-control" name="costo_pago">
                </div>
                <div class="mb-3">
                    <label class="form-label">Transporte</label>
                    <input type="text" class="form-control" name="transporte">
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-label">Total</label>
                    <input type="text" class="form-control" name="total">
                </div> --}}


                <div class="container ">
                    <div class="row">
                        <div class="col d-flex">

                            <div id="btn-cancelar">
                                <a href="" class="btn btn-danger btn-ampliado">Cancelar</a>
                            </div>


                            <div>
                                <button type="submit" class="btn btn-primary btn-ampliado">Agregar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@stop
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('js')
    {{-- select 2  --}}

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>

@endsection
