@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Reporte de pedido cancelados </h1>
@stop
@section('content')

    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">

            <div class="form-group">
                <label for="">Nombre de cliente</label>
                <input type="text" name="" id="" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ $cliente->nombre }}  {{ $cliente->apellido }}" readonly>

            </div>

            <div class="form-group">
                <label for="">Fechas de inicio y final</label>
                <input type="text" value="{{ $fechaInicial->format('d-m-Y') }}" class="form-control" readonly>
                <br>
                <input type="text" value="{{ $fechaFinal->format('d-m-Y') }}" class="form-control" readonly>
            </div>
            <hr>
            <br>
            <div id="container">
                
            </div>

        </div>
    </div>



    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        const cancelado = JSON.parse('<?= $data ?>');
        const NoCancelado = JSON.parse('<?= $dataNoCancelado ?>');
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Pedidos ',
                align: 'left'
            },
            subtitle: {
                // text: 'Source: <a target="_blank" ' +
                //     'href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>',
                align: 'left'
            },
            xAxis: {
                categories: "fechas",
                crosshair: true,
                accessibility: {
                    description: 'Countries'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Numero de pedidos'
                }
            },
            tooltip: {
                valueSuffix: ' '
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                    name: 'Cancelados',
                    data: [cancelado.data]
                },
                {
                    name: 'No cancelados',
                    data: [NoCancelado.data]
                }
            ]
        });
    </script>
@endsection
