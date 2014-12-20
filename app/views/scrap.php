<!DOCTYPE html>
<html>
<head>
	<title>Scrap Test</title>
	<?php include 'dom.php';?>


</head>
<body>
	<?php
		$html = file_get_html('http://www.fragrantica.com/perfume/Acqua-di-Parma/Acqua-di-Parma-Colonia-1681.html');
		foreach($html->find('#mainpicbox img') as $element) 
       	echo $element->src . '<br>'; 
	?>
</body>
</html>