<!doctype html>
<html lang="en">
<head>
	<?php 
		$labels = array();
		$salesdata = array();

		foreach ($data as $dataset) {
			$labels[] = $dataset->SALESDST;
			$salesdata[] = $dataset->SALESAMT;
		}

		$labelset = "['" . implode("','",$labels) . "']";
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
</head>
<body>
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
		            type: 'column',
		            margin: 75,
		            options3d: {
		                enabled: true,
		                alpha: 10,
		                beta: 25,
		                depth: 70
		            }
		        },
		        title: {
		            text: ''
		        },
		        subtitle: {
		            text: ''
		        },
		        plotOptions: {
		            column: {
		                depth: 25
		            }
		        },
		        xAxis: {
            	categories: <?php echo $labelset ?>
        		},
		        yAxis: {
		            opposite: false
		        },
		        series: [{
		            name: 'Sales',
		            data: <?php echo $dataset ?>
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



		
		