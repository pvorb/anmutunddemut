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
if ($flag ==a){
echo "<a href='pantheon.php?flag=b'>";

$zahl = rand(1, 10);
echo "<img src=p";
echo $zahl; 
echo ".jpg";
echo " width=100 height=100 border='0'></a>";
}

if ($flag ==b){
echo "<a href='pantheon.php?flag=c'>";
$zahl = rand(11, 20);
echo "<img src=p";
echo $zahl;
echo ".jpg";
echo " width=100 height=100 border='0'></a>";
}

if ($flag ==c){
echo "<a href='pantheon.php?flag=d'>";
$zahl = rand(21, 30);
echo "<img src=p";
echo $zahl;
echo ".jpg";
echo " width=100 height=100 border='0'></a>";
}

if ($flag ==d){
echo "<a href='pantheon.php?flag=a'>";
$zahl = rand(31, 34);
echo "<img src=p";
echo $zahl;
echo ".jpg";
echo " width=100 height=100 border='0'></a>";
}

if ($flag ==e){
	if ($pluscounter==34) {
		$pluscounter = 0;
	}
$pluscounter ++;
echo "<a href='pantheon.php?flag=e&pluscounter=";
echo $pluscounter;
echo"'>";
echo "<img src=p";
echo $pluscounter;
echo ".jpg";
echo " width=100 height=100 border='0'></a>";
}

if ($flag ==f){
	if ($minuscounter==1) {
		$minuscounter = 35;
	}
$minuscounter --;
echo "<a href='pantheon.php?flag=f&minuscounter=";
echo $minuscounter;
echo"'>";
echo "<img src=p";
echo $minuscounter;
echo ".jpg";
echo " width=100 height=100 border='0'></a>";

}

 
?>

</body>
</html>
