<?php

require_once("php/tools.php");

function makefile($result, $i, $type){
	if($result->code=="200"){
	    // Try to create Folder
	    $names = makefilenfolder($result);
	 	$file = $names["file"];
		$folder = $names["folder"];
		$path = $names["path"];
		$path_array = $names["path_array"];
		$meta = $names["meta"];

	  $filename = makecleanfilename($file, $type, $i);
    $the_path = makepath($folder, $filename);
	    
	    

	  if($h = fopen($the_path, "w+")){
	    	fwrite($h, $result->data);
	    	fclose($h);
	    	print "Got $type ".$i." Path[".$path."] Folder[".$folder."] File[".$file."] The Path [$the_path]\n";
		}else{
			print  "Not $type".$i." Couldn't open the Path [$the_path]\n";
		}
		
	}else{
	  print "Not $type".$i." Code:".$result->code." \n";
	}
}

function makefilenfolder($result){
	foreach(explode("\n", $result->data) as $line){
      // Reset all Variables
      $meta = array();
      $path = "";
      $path_array = array();
      $file = "";
      $folder = "";
      // Create Folder
      if(strpos($line, '<meta name="path"')){
        $meta = explode('"', $line);
        $path = $meta[3];       
        $path_array = explode("/", $path);
		if($path_array[0]==""){
			unset($path_array[0]);
		}
		//print_r($path_array);
        $file = array_pop($path_array);        
        $file = str_replace("&qout", "", $file);
        if(count($path_array)>0){
          $folder = "./".implode("/", $path_array);
          if(!is_dir($folder)){
            mkdir($folder, 0775, true);
          }
        }
        break;
      }
    }
	$return["file"] = $file;
	$return["folder"] = $folder;
	$return["path"] = $path;
	$return["path_array"] = $path_array;
	$return["meta"] = $meta;
	return $return;
}

function makecleanfilename($file, $type, $i){
  // Check on File Name
  if($file!=""){
    $file = str_replace("&quot", "", $file);
    $file = str_replace("&amp", "", $file);
    $file = str_replace("&", "", $file);
    $filename = $file.".html";
  }else{
    $filename = $type."-".$i.".php";
  }
  return $filename;
}

function makepath($folder, $filename){
  if($folder != ""){
    $the_path = $folder."/".$filename;
  }else{
    $the_path = "./seiten/".$filename;
  }
  return $the_path;
}

// Get all Nodes

for($i=1; $i<9000; $i++){
  $result = "";
  $result = http_request("http://anmutunddemut.de/node/".$i."?crawler=true");
  makefile($result, $i, "node");    
}

// Get all Terms

for($i=6000; $i<8000; $i++){
  $result = "";
  $result = http_request("http://anmutunddemut.de/taxonomy/term/".$i."?crawler=true");
  makefile($result, $i, "term");    
}






