@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Reporte de pedido cancelados </h1>
@stop
@section('content')
    {{-- {{ dd($data) }} --}}
    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">

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
