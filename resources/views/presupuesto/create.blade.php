@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('css/btnCancelarAceptar.css') }}">
@section('title')

@section('content_header')
    <h1>Agregar presupuesto</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <form class="form" action="" method="post">

                <div class="mb-3">
                    <label class="form-label">Codigo de presupuesto</label>
                    <input type="text" class="form-control" name="codigo" value="1">
                </div>
                <div class="mb-3">
                    <label class="form-label">Cliente</label>
                    <input type="text" class="form-control" name="cliente">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tiempo vigente del presupuesto</label>
                    <input type="text" class="form-control" name="tiempo_presupuesto">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo de proyecto</label>
                    <input type="text" class="form-control" name="tipo_proyecto">
                </div>
                <div class="mb-3">
                    <label class="form-label">Maximo de revisiones</label>
                    <input type="text" class="form-control" name="max_revision">
                </div>
                <div class="mb-3">
                    <label class="form-label">Clasulas</label>
                    <input type="text" class="form-control" name="clausula">
                </div>
                <div class="mb-3">
                    <label class="form-label">Forma de pago</label>
                    <input type="text" class="form-control" name="forma_pago">
                </div>
                <div class="input-group">
                    <span class="input-group-text">Producto</span>
                    <input type="text" class="form-control" name="producto">
                    <span class="input-group-text">Cantidad</span>
                    <input type="text" class="form-control" name="cantidad_producto">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-text">Material</span>
                    <input type="text" class="form-control" name="material">
                    <span class="input-group-text">Cantidad</span>
                    <input type="text" class="form-control" name="cantidad_material">
                </div>

                <hr>
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
                </div>


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
