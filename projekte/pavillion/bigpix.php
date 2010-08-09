<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Pavillion</title>
	<link rel=stylesheet type="text/css" href="white.css">
</head>
<body>
<?php
	if ($bigpix==9 ){
		$bigpix = 1;
	}
	$newlink =$bigpix+1; 
	echo "<a href='bigpix.php?bigpix=";
	echo $newlink;
	echo  "'>";
	switch($bigpix){
		
		case "1":
		echo "<img src='b13.jpg' width=500 height=100 border='0'>";
		break;
		
		case "2":
		echo "<img src='b5.jpg' width=350 height=100 border='0'>";
		break;
		
		case "3":
		echo "<img src='b4.jpg' width=200 height=100 border='0'>";
		break;
		
		case "4":
		echo "<img src='b3.jpg' width=200 height=100 border='0'>";
		break;
		
		case "5":
		echo "<img src='b9.jpg' width=228 height=100 border='0'>";
		break;
		
		case "6":
		echo "<img src='b14.jpg' width=199 height=100 border='0'>";
		break;
		
		case "7":
		echo "<img src='b15.jpg' width=226 height=100 border='0'>";
		break;
		
		case "8":
		echo "<img src='b11.jpg' width=213 height=100 border='0'>";
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
