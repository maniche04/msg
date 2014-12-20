<!doctype html>
<html lang="en">
<head>
    <?php 
        
        $salesdata = array();

        //echo var_dump ($data) ;
        foreach ($data as $dat) {
                
                
                    if ($dat->month == '1') {

                        $salesdata[] = '[Date.UTC(' . ($dat->year - 1) . ",12," .  $dat->day . ")," . $dat->SALESAMT . ']';
                    } else {
                        $salesdata[] = '[Date.UTC(' . $dat->year . "," . ($dat->month - 1) . "," .  $dat->day . ")," . $dat->SALESAMT . ']';
                    }
              
        }

        //echo var_dump ($salesdata);
        $final_sales_data = '[' . implode(",",$salesdata) . ']';
    
        /*
        echo $labelset;
        echo "<br>";
        echo $dataset;
        */

    ?>
    <meta charset="UTF-8">
    <title>Jizan Sales Trend</title>
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
</head>
<body>
    <div class="welcome">
        <a href="http://laravel.com" title="Laravel PHP Framework">
        </a>
        <h2>Sales Trend</h2>
      
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
                zoomType: 'x'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    '' :
                    'Pinch the chart to zoom in'
            },
            xAxis: {
                type: 'datetime',
                minRange: 14 * 24 * 3600000 // fourteen days
            },
            yAxis: {
                title: {
                    text: 'Sales'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },
    
            series: [{
                type: 'area',
                name: 'Sales',
                pointInterval: 24 * 3600 * 1000,
                data: <?php echo $final_sales_data;?>
            }]
        });
    });
    
    </script>
    </head>
    <body>

    <div id="container" style="height: 600px"></div>
    <?php //echo var_dump($data); ?>
</body>
</html>