@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Detalle del Boceto </h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>
            <a href="{{ route('disenios.show', $boceto->detallePedido->disenio->id) }}" class="btn btn-primary">Ir a
                diseño</a>
        </div>
        {{-- <div class="card-body">

            <div class="row-6">
               
            </div>
            <hr>
            <div class="row-6">

                <div class="col-6"> <br>

                   


                </div>

                <div class="col-6">
                   


                </div>

            </div>



        </div> --}}
        <div class="card-body">
            <div class="container text-left">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Numero de pedido</label>
                            <input type="text" name="" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ $boceto->detallePedido->pedido_id }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nombre del negocio </label>
                            <input type="text" name="" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ $boceto->negocio }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Objetivo del diseño</label>
                            <input type="text" name="" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ $boceto->objetivo }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Publico al que va dirigido</label>
                            <input type="text" name="" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ $boceto->publico }}" readonly>
                        </div>

                        <div class="form-floating">
                            <label for="">Contenido</label>
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" readonly>{{ $boceto->contenido }}</textarea>
                        </div>
                    </div>

                </div>

                <hr>
                <div class="row">
                    <div class="col">
                        <h5 style="text-align: center">Logo de la empresa</h5>
                        <br>
                        <br>
                        @if ($boceto->url_logo != null)
                            <img src="{{ $boceto->url_logo }}" class="img-fluid" alt="Logo" width="200"
                                height="150">
                            <form action="{{ route('descargar_boceto') }}" method="post">
                                @csrf
                                <input type="hidden" name="archivo" value="url_logo">
                                <input type="hidden" name="id" value={{ $boceto->id }}>
                                <br>
                                <button type="submit" class="btn btn-primary">Descargar</button>
                            </form>
                        @else
                            {{ 'No tiene logo' }}
                        @endif
                    </div>

                    <div class="col">
                        <h5 style="text-align: center">Imagen de lo que quiere que se muestre</h5><br>
                        @if ($boceto->url_img != null)
                            <img src="{{ $boceto->url_img }}" class="img-fluid" alt="Imagen" width="400"
                                height="300">
                            <form action="{{ route('descargar_boceto') }}" method="post">
                                @csrf
                                <input type="hidden" name="archivo" value="url_img">
                                <input type="hidden" name="id" value={{ $boceto->id }}>
                                <br>
                                <button type="submit" class="btn btn-primary">Descargar</button>
                            </form>
                        @else
                            {{ 'No tiene imagen o recurso visual' }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
