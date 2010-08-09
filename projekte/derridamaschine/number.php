<?php

$link = mysql_connect("mysql4.domainfactory.de", "db81451", "slHamlet1210");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
//echo 'Connected successfully';
mysql_select_db('db81451', $link);
$sql = "SELECT body FROM drupal_node_revisions";
$result = mysql_query($sql);
$row_counter = 0;
$word_counter = 0;
$char_counter = 0;
while($row = mysql_fetch_assoc($result)){
  $text = strip_tags($row['body']);
  $char_counter = $char_counter + strlen($text);
  $words = explode(" ", $text);
  $word_counter = $word_counter + count($words);
  $char_counter = $char_counter - count($words);
  $row_counter ++;
}
print "anmut und demut beinhaltet ".$char_counter . " zeichen in " . $word_counter . " woertern in ". $row_counter." beitraegen";
mysql_close($link);

?>