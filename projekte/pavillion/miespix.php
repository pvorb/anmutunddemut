<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Pavillion</title>
	<link rel=stylesheet type="text/css" href="white.css">
</head>
<body>
<?php
	if ($miespix==4 ){
		$miespix = 1;
	}
	$newlink =$miespix+1; 
	echo "<a href='miespix.php?miespix=";
	echo $newlink;
	echo  "'>";
	switch($miespix){
		
		case "1":
		echo "<img src='b12.jpg' width=100 height=100 border='0'>";
		break;
		
		case "2":
		echo "<img src='b8.jpg' width=100 height=100 border='0'>";
		break;
		
		case "3":
		echo "<img src='b16.jpg' width=100 height=100 border='0'>";
		break;
				
		default:
		echo "irgendwas ist schief gelaufen...";
   }
	echo "</a>";
?>


<br>
<img src="b13.jpg" width=500 height=50 alt="" border="0">
</body>
</html>
