<?

/* Tiny Skript to generate an RSS-Feed from my Homepage.
  @author benjamin birkehake <benjamin@birkenhake.org>

*/


include ("heimweh.php");
$nodes = xml_load_nodes("../");

//print count($nodes);
//print_r($nodes);

/*
$handle = fopen("../rss.xml", "w+");
fwrite ($handle, "");
*/

header("Content-Type:	application/xml");
print '<?xml version="1.0" encoding="utf-8"?>';
?>

<rss version="2.0" xml:base="http://anmutunddemut.de" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <title>anmut und demut</title>
    <link>http://anmutunddemut.de</link>
    <description>Kirchenlieder für die Ungläubigen seit 2001</description>
    <language>de</language>
    <atom:link href="http://anmutunddemut.de/rss.xml" rel="self" type="application/rss+xml" />     
    <?php
    
    foreach($nodes as $node){
      print document_get_rss("../".$node["path"]);
    }
    
    ?> 
  </channel>
</rss>