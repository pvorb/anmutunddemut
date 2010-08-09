<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Pavillion</title>
	<link rel=stylesheet type="text/css" href="white.css">
</head>
<body>
<?php
	if ($smallpix==6 ){
		$smallpix = 1;
	}
	$newlink = $smallpix+1; 
	echo "<a href='smallpix.php?smallpix=";
	echo $newlink;
	echo  "'>";
	switch($smallpix){
		
		case "1":
		echo "<img src='b2.jpg' width=100 height=100 border='0'>";
		break;
		
		case "2":
		echo "<img src='b1.jpg' width=100 height=100 border='0'>";
		break;
		
		case "3":
		echo "<img src='b6.jpg' width=100 height=100 border='0'>";
		break;
		
		case "4":
		echo "<img src='b10.jpg' width=100 height=100 border='0'>";
		break;
		
		case "5":
		echo "<img src='b7.jpg' width=100 height=100 border='0'>";
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
