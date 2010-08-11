<?php


// ########## Load General Tools
require_once("config.php");
require_once("tools.php");




// ########## Several Functions to work on documents

function document_load($path){
  $path = "../".$path;
  
  $document["path"] = $path;
  $document["title"] = "";
  $document["date"] = "";
  $document["text"] = "";
  $document["teaserimage"] = "";
  $document["commentcount"] = "";
  $document["status"] = "";
  $document["source"] = "";
  $document["messages"] = array();
  
  if(file_exists($path)){
    $document["messages"][] = "Document exist at ".$path;
    $file = @file_get_contents($path);
    //$document["source"] = $file;
    $document["title"] = string_get_string_between("<h2>", "</h2>", mark_get_mark("node", $file));
    $document["teaserimage"] = mark_get_mark("teaserimage", $file);
    $document["text"] = mark_get_mark("text", $file);
    $document["date"] = date_strtotime_german(mark_get_mark("date", $file));
    $document["commentcount"] = substr_count( $file, '<!-- start:kommentar -->');
  }else{
    $document["messages"][] = "Document doesn't exist at ".$path;
  }
  
  return $document;
}


function document_get_rss($path){
  $document = document_load($path);
  $output  = "";
  $output .= "  <item>\n";
  $output .= "    <title>".$document["title"]."</title>\n";
  $output .= "    <link>".BASE.$path."</link>\n";  
  $output .= "    <description>\n";
  $output .= htmlspecialchars(str_replace("src='", " width='300' src='".BASE.str_replace("../", "",directory_get_folder_from_path("../".$path))."/", $document["teaserimage"]));
  $output .= htmlspecialchars($document["text"]);
  $output .= "    </description>\n";  
  $datestring = $document["date"][0]." ".date_number_to_month_english($document["date"][1])." ".$document["date"][2];
  $timestamp = strtotime($datestring);
  $output .= "    <pubDate>".date("r", $timestamp)."</pubDate>\n";
  $output .= "    <dc:creator>ben_</dc:creator>\n";
  $output .= "    <guid isPermaLink='false'>$path at http://anmutunddemut.de </guid>";  
  $output .= "  </item>\n"; 
  return $output;
  
}



// ########## Several Function to work with crop marks.
 
function mark_get_mark($mark, $file){
  $mark_start = "<!-- start:$mark -->";  
  $mark_end = "<!-- end:$mark -->";  
  return string_get_string_between($mark_start, $mark_end, $file);
}






// ########### Several Functions for the Homepage

function homepage_load_nodes(){
  $homepage = @file_get_contents("../index.php");
  $nodes = explode("<!-- node -->", $homepage);
  array_shift($nodes);
  array_pop($nodes);
  return $nodes;
}