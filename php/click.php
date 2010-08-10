<?php 
// Tiny Skript to click do something with my stuff.

// Do something here

// Tiny Clicktracker
/*
if($_SERVER["HTTP_REFERER"]!=""){
  $file = fopen("counter.txt", "a+");
  fwrite($file, time()." | ".$_SERVER["HTTP_REFERER"]."\n");
  fclose($file);
}*/

// Finally create and deliver image here
header ("Content-type: image/png");
$im = @ImageCreate (1, 1)
      or die ("Kann keinen neuen GD-Bild-Stream erzeugen");
$background_color = ImageColorAllocate ($im, 255, 255, 255);
$text_color = ImageColorAllocate ($im, 255, 255, 255);
ImagePNG ($im);
