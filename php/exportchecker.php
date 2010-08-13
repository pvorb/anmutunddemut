<?

$file = file("drupal_url_alias.csv");
$counter = 0;
foreach($file as $line){
  $array = explode(";", $line);
  //print $array[1];
  $name = "../".trim($array[1]).".html";
  if(!file_exists($name)){
    print "ERROR: ".$name."\n";
    die;
    $counter ++;
  }
}
print $counter." Errors\n";