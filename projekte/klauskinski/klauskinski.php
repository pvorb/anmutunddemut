<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN">
<html>
<head>
<title>Neues Dokument</title>
<link rel="stylesheet" type="text/css" href="klauskinski.css">
</head>
<body>
<table class="frame">
<tr>
<td class="frame">
<table>
	<tr><td><strong class="red">k</strong>LAUS <strong class="red">k</strong>INSKI</td></tr>
	<tr><td><?php
		if ($kk == ""){$kk=1;}
		if ($kk>=17){$kk=1;}
		$kk++;
		echo "<a href=\"klauskinski.php?kk=".$kk."\">";
		$kk--;
		echo "<img src=\"Klaus".$kk.".jpg\" width=\"320\" height=\"320\"></img></a>";
		$kk++;
	
	?></td></tr>
	<tr><td></td></tr>
</table>
</td>
</tr>
</table>
</body>
</html>