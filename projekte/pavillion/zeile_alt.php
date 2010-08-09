<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Pavillion</title>
	<link rel=stylesheet type="text/css" href="white.css">
	<META HTTP-EQUIV="Expires" CONTENT="Tue, 01 Jan 1980 1:00:00 GMT">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
</head>
<body>
<?php
srand ((double)microtime()*1000000);
if ($flag ==1){
	echo "<div align='right'>&nbsp;</div>";
	echo "<div align='left'>&nbsp;</div>";
	echo "<div align='right'><a href='zeile.php?flag=2'>Mehr</a></div>";
}
if ($flag ==2){
	echo "<div align='right'><a href=zeile.php?flag=1'>Weniger</a></div>";
	$zahl = rand(1, 3);
	if ($zahl==1){
		echo "<div align='left'>Weniger ist Mehr</div>";
	}
	if ($zahl==2){
		echo "<div align='left'>Das Knistern, wenn mein Monitor in den Stromsparmodus schaltet</div>";
	}
	if ($zahl==3){
		echo "<div align='left'>Manche Fehler kann man gar nicht oft genug machen</div>";
	}
		echo "<div align='right'><a href='zeile.php?flag=3'>Mehr</a></div>";
}

if ($flag ==3){
	echo "<div align='right'><a href=zeile.php?flag=1'>Weniger</a></div>";
	$zahl = rand(1, 3);
	if ($zahl==1){
		echo "<div align='left'>Weniger ist Mehr</div>";
	}
	if ($zahl==2){
		echo "<div align='left'>Das Knistern, wenn mein Monitor in den Stromsparmodus schaltet</div>";
	}
	if ($zahl==3){
		echo "<div align='left'>Manche Fehler kann man gar nicht oft genug machen</div>";
	}
		echo "<div align='right'><a href='zeile.php?flag=2'>Mehr</a></div>";
}

?>
</body>
</html>
