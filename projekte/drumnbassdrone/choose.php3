<html>
<head>
<title>drum::n::bassdrone[choose the right one]</title>

<link rel="stylesheet" href="dnbdrone.css" type="text/css">

</head>
<body>
<br>
<div class="line">
..................................................................................................................................................................................................................<br>
</div>

<div class="topic">
<a href="choose.php3?flag=1">Projekt::il</a><br>
<a href="choose.php3?flag=2">Die Drone</a><br>
<a href="choose.php3?flag=3">dnb::poem <b class="vio">[</b>1<b class="vio">]</b></a><br>
<a href="choose.php3?flag=4">text</a><br>
<a href="choose.php3?flag=5">FlightDrone</a><br>
<a href="choose.php3?flag=6">Scanned Space</a><br>
<a href="choose.php3?flag=7">dnb::poem <b class="vio">[</b>2<b class="vio">]</b></a><br>
<a href="choose.php3?flag=8">SpaceDrone</a><br>
<a href="kemistrystorm1.php3">Kemistry & Storm <b class="vio">[</b>1<b class="vio">]</b></a><br>
<a href="choose.php3?flag=9">Talking Samples</a><br>
<a href="choose.php3?flag=10">CellDrone</a><br>
<a href="choose.php3?flag=11">EnergyDrone</a><br>
<a href="choose.php3?flag=12">Zen</a><br>
<b class="vio">[</b><a href="mailto:drumnbassdrone@uboot.com">Contact</a></a><b class="vio">]</b>
</div>


<?php
	
	if ($flag=="" ){
		echo "<div class=super>";
		echo "<a href='index.html'>";
		echo "<img src='dnbdrone.jpg' border=no border></a><br>";
		echo "</div>";
		echo "<div class=randchoose>";
		include ("rand.xml");
		echo "</div>";
	}

	if ($flag ==1) {
		echo "<div class=randchoose>";
		include ("rand.xml");
		echo "</div>";
		echo "<div class=textchoose>";
		include ("projekt.xml");
		echo "</div>";
		echo "<div class=super>";
		echo "<a href='index.html'>";
		echo "<img src='dnbdrone.jpg' border=no border></a></div>";
		echo "<div class=sourcechoose>by::verstaerker</div>";
	} 
	
	if ($flag ==2) {
		echo "<div class='randchoose'>";
		include ("rand.xml");
		echo "</div>";
		echo "<div class=textchoose>";
		echo "Die Drone ist auf ihrem Weg. 
Sie hat die letzten Kontrollposten ihres Raumsektors verlassen.
Vor ihr liegt die finale Grenze.
Die letzten Bässe reflektiern noch von ihrer violetten Oberfläche.
The Beauty and The Beats.
Der Rand des Universums.
Mutig zu gehen wohin niemand  zuvor ging.
Hinter ihr liegt das SonicFictionEmpire. 
Der besiedeltet Teil des Weltraums.
Den sich Sounds, Drums, Breats und der Bass Teilen.
Vor ihr liegen die Silentdomains.
Das unentdeckte Land, von des Bezirk keine Wanderer zurückgehert.
Stille herrscht hier.
Hätte die Drone Empfindungen würde sie sich fürchten.
Doch sie ist nur Technik, Theorie, Struktur.
Vollgestopft mit Highend Konzepten der letzten Generation.
Ihre Mission:
Der erste Kontakt.
Sehen wer da lebt, jenseits der Grenzen
Vor ihr liegt der Raum der Textronen.
Still aber....
ihre optischen Sensoren können kaum alle Reize aufnehmen.
Information overload.
Graphische Zeichen überall!
Bedroht? Umzingelt!
Aber die Drone bleibt ruhig.
Sie könnte auch nicht anders, selbst wenn sie wollte.
Gegenmaßnahmen werden eingeleitet.
Drums werden ausgesandt.
Die AlienZeichen werden gescannt.
Die Drone erkennt Strukturen wieder.
Die Bässe werden aktiviert.
Erst nur langsam, kaum merklich.
Dann aber immer deutlicher.
Es bilden sich bekannten Konzpete im Textraum aus.
Breakbeatbuchstaben und Soundsätze.
Der erste Kontakt ist hergestellt.
Die Kommunikation funktioniert.
Auftrag ausgeführt.";
		echo "</div>";
		echo "<div class=super>";
		echo "<a href='index.html'>";
		echo "<img src='dnbdrone.jpg' border=no border></a></div><br>";
		echo "<div class=sourcechoose>by::verstaerker</div>";
	} 
	
	if ($flag ==3) {
		echo "<div class='rand-poem'>";
		include ("rand.xml");
		echo "</div>";
		echo "<div class=text-poem>";
		include ("dnb-poem1.xml");
		echo "</div>";
		echo "<div class=super>";
		echo "<a href='index.html'>";
		echo "<img src='dnbdrone.jpg' border=no border></a></div><br>";
	} 
	
	if ($flag ==4) {
		echo "<div class='randchoose'>";
		include ("rand.xml");
		echo "</div>";
		echo "<div class=textchoose>";
		include ("text.xml");
		echo "</div>";
		echo "<div class=super>";
		echo "<a href='index.html'>";
		echo "<img src='dnbdrone.jpg' border=no border></a></div><br>";
		echo "<div class=sourcechoose></div>";
	} 
	
	if ($flag ==5) {
		echo "<div class='rand-poem'>";
		include ("rand.xml");
		echo "</div>";
		echo "<div class=text-poem>";
		echo "<img src=\"flightdrone.jpg\"  alt=\"The Drones' ReTurn\" border=\"0\">";
		echo "</div>";
		echo "<div class=super>";
		echo "<a href='index.html'>";
		echo "<img src='dnbdrone.jpg' border=no border></a></div><br>";
		echo "<div class=source-poem>Die Drone ist zur&uuml;ckgehert :: Datendownload :: Konzeptechniker <br></div>";
	} 
	
	if ($flag ==6) {
		echo "<div class='randchoose'>";
		include ("rand.xml");
		echo "</div>";
		echo "<div class='textchoose'>";
		include ("scanned.xml");
		echo "</div>";
		echo "<div class=super>";
		echo "<a href='index.html'>";
		echo "<img src='dnbdrone.jpg' border=no border></a></div><br>";
		echo "<div class=sourcechoose>text::web::space scanned [dnbdrone]</div>";
	} 
	
	if ($flag ==7) {
		echo "<div class='randchoose'>";
		include ("rand.xml");
		echo "</div>";
		echo "<div class='textchoose'>";
		include ("dnb-poem2.xml");
		echo "</div>";
		echo "<div class=super>";
		echo "<a href='index.html'>";
		echo "<img src='dnbdrone.jpg' border=no border></a></div><br>";
		echo "<div class=sourcechoose>by::verstaerker</div>";
	}
	
	if ($flag ==8) {
		echo "<div class='rand-poem'>";
		include ("rand.xml");
		echo "</div>";
		echo "<div class='text-poem'>";
		echo "<img src=\"spacedrone.jpg\"  alt=\"Risszeichnung einer SpaceDrone\" border=\"0\">";
		echo "</div>";
		echo "<div class=super>";
		echo "<a href='index.html'>";
		echo "<img src='dnbdrone.jpg' border=no border></a></div><br>";
		echo "<div class=source-poem>Die Drone in den technischen Details :: Blaupausen :: Risszeichnung<br></div>";
	} 
	
	if ($flag ==9) {
		echo "<div class='randchoose'>";
		include ("rand.xml");
		echo "</div>";
		echo "<div class='textchoose'>";
		include ("talkingsamples.xml");
		echo "</div>";
		echo "<div class=super>";
		echo "<a href='index.html'>";
		echo "<img src='dnbdrone.jpg' border=no border></a></div><br>";
		echo "<div class=sourcechoose>vocal samples<br> dnb talks </div>";
	} 
	
	if ($flag ==10) {
		echo "<div class='rand-poem'>";
		include ("rand.xml");
		echo "</div>";
		echo "<div class='text-poem'>";
		echo "<img src=\"celldrone.jpg\" alt=\"Celldrone\" border=\"0\">";
		echo "</div>";
		echo "<div class=super>";
		echo "<a href='index.html'>";
		echo "<img src='dnbdrone.jpg' border=no border></a></div><br>";
		echo "<div class=source-poem>Die Drone wird zur Zelle :: Sie nimmt Konzepte auf :: Mutation :: Evolution </div>";
	} 
	
	if ($flag ==11) {
		echo "<div class='rand-poem'>";
		include ("rand.xml");
		echo "</div>";
		echo "<div class='text-poem'>";
		echo "<img src=\"energydrone.jpg\" alt=\"Energydrone\" border=\"0\">";
		echo "</div>";
		echo "<div class=super>";
		echo "<a href='index.html'>";
		echo "<img src='dnbdrone.jpg' border=no border></a></div><br>";
		echo "<div class=source-poem>Die Drone ist Energiegeladen :: Kernspin :: Turntablespin </div>";
	} 
	
	if ($flag ==12) {
		echo "<div class='randchoose'>";
		include ("rand.xml");
		echo "</div>";
		echo "<div class='textchoose'>";
		include ("zen.xml");
		echo "</div>";
		echo "<div class=super>";
		echo "<a href='index.html'>";
		echo "<img src='dnbdrone.jpg' border=no border></a></div><br>";
		echo "<div class=sourcechoose>Der Weg ist unter deinen Fingern<br>
				::oder::<br>
				Zen in den Kunst des Plattendrehens<br><br>
				by::verstaerker<br>
</div>";
	} 
	
	if ($flag ==x) {
		echo "<div class='randchoose'>";
		include ("rand.xml");
		echo "</div>";
		echo "<div class='textchoose'>";
		
		echo "</div>";
		echo "<div class=super>";
		echo "<a href='index.html'>";
		echo "<img src='dnbdrone.jpg' border=no border></a></div><br>";
		echo "<div class=sourcechoose></div>";
	} 
?>

</body>