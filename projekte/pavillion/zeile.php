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

if ($flag==2){
	$zahl = rand(1, 8);
   echo "<div align='right'><a href=zeile.php?flag=1'>Weniger</a></div>";
   switch($zahl){

     case "1":
	echo "<div align='left'>Weniger ist Mehr</div>";
	break;

     case "2":
	echo "<div align='left'>Das Knistern, wenn mein Monitor in den Stromsparmodus schaltet</div>";
	break;
     
	 case "3":
	echo "<div align='left'>Manche Fehler kann man gar nicht oft genug machen</div>";
	break;
	
	case "4":
	echo "<div align='left'>Aber das Gef&uuml;hl ist ja da</div>";
	break;
	
	case "5":
	echo "<div align='left'>Es hat uns niemand versprochen, dass Leben w&uuml;rde einfach werden</div>";
	break;
	
	case "6":
	echo "<div align='left'>Der Moment, in dem dein Lachen zum Gegacker wird</div>";
	break;
	
	case "7":
	echo "<div align='left'>Form follows Function</div>";
	break;
	
	case "8":
	echo "<div align='left'>Der Rest ist Schweigen</div>";
	break;
	 
	 default:
     echo "irgendwas ist schief gelaufen...";
   }
   echo "<div align='right'><a href=zeile.php?flag=2'>Mehr</a></div>";
}

?>
</body>
</html>
