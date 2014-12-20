@extends('base')

@section('addhead')
    <?php 
        
        $salesdata = array();

        foreach ($data as $dataset) {
            $salesdata[] = "['" . $dataset->SALESDST . "'," . $dataset->SALESAMT . "]";
        }

        $dataset = '[' . implode(',',$salesdata) . ']';

        /*
        echo $labelset;
        echo "<br>";
        echo $dataset;
        */

    ?>
    <meta charset="UTF-8">
    <title>Laravel PHP Framework</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <?php echo HTML::script('hc/js/highcharts.js'); ?>
    <?php echo HTML::script('hc/js/highcharts-3d.js'); ?>
    <?php echo HTML::script('hc/js/modules/exporting.js'); ?>

    <style>
        @import url(//fonts.googleapis.com/css?family=Lato:700);

        body {
            margin:0;
            font-family:'Lato', sans-serif;
            text-align:center;
            color: #999;
        }

        .container{
            width: 500;
            height: 200px;
            position: absolute;
            left: 50%;
            top: 20%;
            margin-left: -150px;
            margin-top: -100px;
        }

        a, a:visited {
            text-decoration:none;
        }

        h1 {
            font-size: 32px;
            margin: 16px 0 0 0;
        }
    </style>
@stop


@section('body')


    <div class="welcome">
        <a href="http://laravel.com" title="Laravel PHP Framework">
        </a>
        <h1>Jizan Perfumes LLC</h1>
        <h3>Test Sales Report</h3>
    </div>

    <!-- begin showing the chart from here !-->

    <style type="text/css">
        #container {
            height: 500px; 
            min-width: 610px; 
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
    <script type="text/javascript">
        $(function () {
            $('#container').highcharts({
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                title: {
                    text: ''
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b> : {point.percentage:.1f}%'
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Sales Contribution',
                    data: <?php echo $dataset ?>
                }]
            });
        });
    </script>
    </head>
    <body>

    <div id="container" style="height: 600px"></div>
    <?php //echo var_dump($data); ?>

@stop

