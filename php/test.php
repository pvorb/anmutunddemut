<pre>
<?php

require_once("heimweh.php");

$docs = directory_to_array_recursive("..");
foreach($docs as $doc){
  if(substr($doc, -4, 4)=="html"){
    $das = document_load($doc);
    if(stripos(strip_tags($das["source"], "<img><a>"), $_GET["q"])){
      print $doc."\n";
    }
  }
}
?>
</pre>