<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	<?php echo HTML::script('js/jquery.js');?>
	<?php echo HTML::script('js/notify.js');?>
	<?php echo HTML::script('ht/jquery.handsontable.full.js');?>
	<?php echo HTML::style('css/fa/font-awesome.css');?>
	<?php echo HTML::style('ht/jquery.handsontable.full.css');?>
	<?php if ($flash) { ?>
		<script>
			$( document ).ready(function(){
				$.notify("Hi "+ '<?php echo Auth::user()->firstname ?>' + ', welcome back!',
						{
						  // whether to hide the notification on click
						  clickToHide: true,
						  // whether to auto-hide the notification
						  autoHide: true,
						  // if autoHide, hide after milliseconds
						  autoHideDelay: 10000,
						  // show the arrow pointing at the element
						  arrowShow: true,
						  // arrow size in pixels
						  arrowSize: 5,
						  // default positions
						  elementPosition: 'bottom left',
						  globalPosition: 'top right',
						  // default style
						  style: 'bootstrap',
						  // default class (string or [string])
						  className: 'success',
						  // show animation
						  showAnimation: 'slideDown',
						  // show animation duration
						  showDuration: 400,
						  // hide animation
						  hideAnimation: 'slideUp',
						  // hide animation duration
						  hideDuration: 200,
						  // padding between element and notification
						  gap: 2
						}
					);
			});
		</script>


	<?php } ?>

	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
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
	<div id ='message'>
	
	</div>
	<div class="welcome">
		
		<i class="fa fa-circle-o-notch fa-spin fa-1x"></i>
		<h4>Demo Query</h4>
		<br>
		<br>
		<div id="dataTable"></div>
		
	</div>
	
	<script>
	  	var data = [
  ["", "Kia", "Nissan", "Toyota", "Honda"],
  ["2008", 10, 11, 12, 13],
  ["2009", 20, 11, 14, 13],
  ["2010", 30, 15, 12, 13]
];

$("#dataTable").handsontable({
  data: data,
  minRows: 5,
  minCols: 6,
  minSpareRows: 1,
  currentRowClassName: 'currentRow',
  currentColClassName: 'currentCol',
  autoWrapRow: true,
  rowHeaders: true,
  colHeaders: true
});

$("#dataTable").handsontable('selectCell', 3, 3);
	</script>

</body>
</html>
