<pre>
<?
//db81451:slHamlet1210@mysql4.domainfactory.de/db81451
$db = mysql_connect("mysql4.domainfactory.de", "db81451", "slHamlet1210");
mysql_select_db("db81451", $db);

$xml = simplexml_load_file('drupal_teaserimage.xml');

foreach($xml as $ti){
  
  $found = false;
  $sql = "SELECT nid, field_teaserimage_value FROM drupal_content_field_teaserimage WHERE nid = '".$ti->nid."' ";
  $result1 = mysql_query($sql);
  while($line = mysql_fetch_array($result1, $db)){
   if($line["field_teaserimage_value"]!=""){
     print $ti->nid." ".$line["field_teaserimage_value"]."\n";
   }else{
     print $ti->nid." ist da aber leer.\n";
     $sql = "UPDATE drupal_content_field_teaserimage SET field_teaserimage_value = '".$ti->url."' WHERE nid = '".$ti->nid."' ";
     print $sql."\n";
     //$result2 = mysql_query($sql);
   }
   $found = true;
  }
  
  if(!$found){
     $sql1 = "INSERT INTO drupal_content_field_teaserimage (nid, vid, field_teaserimage_value) VALUES ('".$ti->nid."', '".$ti->nid."', '".$ti->url."')";
     
     $sql2 = "INSERT INTO drupal_content_type_".$ti->type." (nid, vid) VALUES ('".$ti->nid."', '".$ti->nid."')";
     //mysql_query($sql1);
     //mysql_query($sql2);
     print $ti->nid." ist noch leer. \n $sql1 \n $sql2 \n \n";
    
  }
}




?>
</pre>