<?php

include("tools.php");

$error = false;
$messages = array();
$vars = sanitize_array($_POST);

//phpinfo();
$messages[] = "Me:[".$_SERVER["REQUEST_URI"]."]";
$messages[] = "Ref: [".$_SERVER["HTTP_REFERER"]."]";

$file = "..".str_replace("http://anmutunddemut.de", "", $_SERVER["HTTP_REFERER"]);

$messages[] = "File: [".$file."]";


$messages[] = "Name: ".$vars["name"];
$messages[] = "Mail: ".$vars["mail"];
$messages[] = "Homepage: ".$vars["homepage"];
$messages[] = "Text: ".$vars["text"];

if($vars["name"]!="" and $vars["text"]!=""){
  // Weitermachen, wenn die Datei exisitert
  if($file!="" and file_exists($file)){
    $messages[] = "File Exits";
    // Weitermachen, wenn die Datei lesbar ist
    if($file_string = @file_get_contents($file)){
      $messages[] = "File is readable";
      $file_array = explode("<!-- Last Comment standing -->", $file_string);
      // Weitermachen, wenn die Kommentarschnittmarkt im HTML ist;
      if(count($file_array)>1){
        $messages[] = "File has a last Comment standing";       
        $handle = fopen ($file, "w+");   
        $number = substr_count( $file_string, '<!-- start:kommentar -->') + 1;
        // Kommentar formatieren       
        $kommentar  = "\n";
        $kommentar .= '  <div class="comment">'."\n"; 
        $kommentar .= '      <!-- start:kommentar -->'."\n"; 
        $kommentar .= '      <hr />'."\n"; 
        if($vars["homepage"]!=""){
          $kommentar .= '      <p class="metadata">von <a href="'.$vars["homepage"].'">'.$vars["name"].'</a> '."\n";
        }else{
          $kommentar .= '      <p class="metadata">von '.$vars["name"]."\n";
        }      
        $kommentar .= '      <a href="'.$_SERVER["HTTP_REFERER"].'#comment-'.$number.'" id="comment-'.$number.'" class="active">#</a>      </p>'."\n"; 
        $kommentar .= '     '.string_autop($vars["text"])."\n"; 
        $kommentar .= '     <!-- ende:kommentar -->'."\n";   	
        $kommentar .= '  </div>'."\n";
        $file_array[0]  .= $kommentar;
      
      
        $file_string = implode ("\n\n  <!-- Last Comment standing -->", $file_array);
        fwrite ($handle, $file_string);
        fclose ($handle);       
      }else{
        $messages[] = "File has not last Comment standing";
        $error = true;
      }   
    }else{
      $error = true;
    }  
  }else{
    $messages[] = "File doesn't exist";
    $error = true;
  }
}else{
  $messages[] = "Name and Text empty";
  $error = true;
}

// Allgemeine Auswertung
if($error){
  $messages[] = "FAILURE: Couldn't comment";  
}else{
  $messages[] = "SUCCESS: Added Comment to ".$_SERVER["HTTP_REFERER"]."#comment-".$number;
}

// So oder so wird eine Mail geschickt.
$mailkommentar  = "";
$mailkommentar.= "Von:".$vars["name"]." ".$vars["homepage"]."\n\n";
$mailkommentar.= "Kommentar:\n".$vars["text"]."\n\n";
$mailkommentar.= "Link: ".$_SERVER["HTTP_REFERER"]."#comment-$number \n\n";

// Anrede
$mailmessage  = "Hi Du,\n\nEs gibt einen neuen Komemntar zum Beitrag ".$_SERVER["HTTP_REFERER"]."\n\n";
$mailmessage .= $mailkommentar;

// Deuggin'
$mailmessage .= "De:Buggin Start:\n";
$mailmessage .= implode("\n", $messages)."\n\n";
$mailmessage .= "De:Buggin Ende:\n";

// Footer
$mailmessage .= "\nLiebe Grüße,\nben_bot";

$mailmessage;

if($vars["name"]!="" and $_SERVER["HTTP_REFERER"]!=""){
  if(mail("benjamin@birkenhake.org", "[anmut und demut] Neuer Kommentar von ".$vars["name"], $mailmessage, "From:benjamin@birkenhake.org")){
    $messages [] = "Sent Mail";
  }else{
    $messages [] = "Didn't Mail";
  }
}

if(!$error){
  header ("Location:".$_SERVER["HTTP_REFERER"]."#comment-".$number);
}




