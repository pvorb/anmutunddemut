<title>Heimweh Cronjob</title>
<h1>Heimweh Cronjob</h1>
<?php

/* My tiny little Cron Job 
  @author benjamin birkenhake <benjamin@birkenhake.org>


  If only I had an enemy bigger than my apathy, I could have won.

*/

print "<p>Cronjob starts at ".date("d. m. Y. h:i", time())." [".time()."]</p>";

// ########## Load my Heimweh
require_once("heimweh.php");




// ########## Generate the rss.xml

$result = http_request("http://anmutunddemut.de/php/feed.php");
$file = fopen("../rss.xml", "w+");
fwrite($file, $result->data);
fclose($file);

print "<p>Generated RSS Feed.</p>";

// ########## Do some Moblogging, maybe

include("moblog.php");

print "<p>Cronjob ends at ".date("d. m. Y. h:i", time())." [".time()."]</p>";

