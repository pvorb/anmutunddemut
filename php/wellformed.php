
<?php
include("heimweh.php");
$docs = directory_to_array_recursive("..");
foreach($docs as $doc){    
  if(substr($doc, -4, 4)=="html"){
    $xml = simplexml_load_file($doc);
    if(get_class($xml)!="SimpleXMLElement"){
      print $doc." is not wellformed \n";
      break;
    }
  }
  unset($xml);
}
?>    
  