<?php

/* My tiny little Cron Job 
  @author benjamin birkenhake <benjamin@birkenhake.org>


  If only I had an enemy bigger than my apathy, I could have won.

*/


// ########## Load my Heimweh
require_once("heimweh.php");




// ########## Generate the rss.xml

$result = http_request("http://anmutunddemut.de/php/feed.php");
$file = fopen("../rss.xml", "w+");
fwrite($file, $result->data);
fclose($file);



