<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>drum::n::bassdrone[alien::book]</TITLE>
</HEAD>
<LINK href="dnbdrone.css" type=text/css rel=stylesheet>
<BODY>
 <div class="line">
..................................................................................................................................................................................................................<br>
</div>
<div class=super>
<A href="index.html">
<IMG src="dnbdrone.jpg" border="no border"></A> 
<br>
<br>
<b>das digitale alien::book</b>
<br>
<br>
<br>
<a href="dnbbook.php3?flag=1">
want da post a comment?
</a>
<br><br><br>
<br><br><br>
[<a href="mailto:drumnbassdrone@uboot.com"><b class=vio>email</b></a>]
</div>





<?php

	echo "<div class=randchoose>";
	include ("rand.xml");
	echo "</div>";

	if ($flag ==1){
		echo "<div class=dnbbookentry>";
		echo "<form method=POST action=dnbbook.php3>";
		echo "name:<br><textarea rows=1 name=name cols=20></textarea>";
		echo "<br><br>";
		echo "email:<br><textarea rows=1 name=email cols=20></textarea>";
		echo "<br><br>";
		echo "comment:<br><textarea rows=10 name=text cols=20></textarea>";
		echo "<br><br>";
		echo "<input type=submit value=OK name=ok>&nbsp";
		echo "<input type=reset value=Abbrechen name=loeschen>";
		echo "</form></div>";
	}

	
	
	echo "<div class=dnbbook>";
	include ("dnbbook.xml");
	echo "</div>";
	
?>
</body>

</html>
