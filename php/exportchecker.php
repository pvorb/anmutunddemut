
<?

$file = file("drupal_url_alias.csv");
$counter = 0;
$aliase = array();
foreach($file as $line){
  $array = explode(";", $line);
  //print $array[1];
  $aliase[] = $array[0];
  $name = "../".trim($array[1]).".html";
  if(!file_exists($name)){
    print "Cannot find File: ".$name."\n";
    //die;
    
  }
}

//print_r($aliase);

$file2 = file("drupal_node.csv");

foreach($file2 as $line){
  $array = array();
  $array = explode(";", $line);
  if(!in_array("node/".trim($array[0]), $aliase)){
    print "Cannot find Node: ".$array[0]." - ".$array[1];
    $counter ++;
  }
  
}



print $counter." Errors\n";