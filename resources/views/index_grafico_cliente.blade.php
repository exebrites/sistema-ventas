@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Pedidos Cancelados y NO cancelados por cliente </h1>
@stop
@section('content')


    <form action="{{ route('graficoCliente') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Fecha de inicio</label>
            <input type="date" name="inicio" id="" class="form-control" required>
            @error('inicio')
                <br>
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Fecha final</label>
            <input type="date" name="final" id="" class="form-control" required>
            @error('final')
                <br>
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="cliente">Clientes</label>
             <select class="form-select" id="selector-clientes" data-placeholder="Seleccione una cliente"
                name="cliente_id" required>
                <option></option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }} </option>
                @endforeach
                </select>
                @error('cliente_id')
                    <br>
                    <small style="color:red">{{ $message }}</small>
                @enderror
        </div>



        <button type="submit" class="btn btn-primary">Generar grafico</button>
    </form>



@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

@endsection
{{-- @section('js')
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    

@endsection --}}
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $('#selector-clientes').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
@stop
