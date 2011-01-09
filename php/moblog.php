<?php

//phpinfo();

require_once("email.class.php");
require_once("config.php");
require_once("tools.php");

$email = new email(MOBLOG_SEVER, MOBLOG_PORT, MOBLOG_USER, MOBLOG_PASSWORD, "..".MOBLOG_FOLDER);

$email->get_all_mail();
// If there are any Mails, make nodes of them
if(is_array($email->mails)){
  $template = @file_get_contents("moblog-template.html");
  $template_parts = explode("<!-- moblog -->", $template);
	foreach ($email->mails as $mail) {
	  
	  // Build the HTML
	  $result = array();
	  $result[] = $template_parts[0];
	  $result[] = $mail["subject"];
	  $result[] = $template_parts[1];
 	  $result[] = $mail["subject"];
 	  $result[] = $template_parts[2];
 	  $body = "";
 	  if(is_array($mail["image"])){
 	    foreach($mail["image"] as $image){
 	      if($image["data"]!="" and $image["name"]!=""){
 	        $body .= '<p class="moblogimage"><img src="http://anmutunddemut.de'.MOBLOG_FOLDER.$image["name"].'"></p>'."\n\n"; 
 	      }
 	    }	   
 	  }
 	  $body .= str_replace("<br />", "", string_autop($mail["text"]));
 	  $result[] = $body;
 	  $result[] = $template_parts[3];
 	  $result[] = date("j. n. Y", $mail["date"]["timestamp"]);
 	  $result[] = $template_parts[4];
	  $html = implode($result);
	 
	  //  Create the folder
	  $path_array = array();
	  $path_array[] = date("Y", $mail["date"]["timestamp"]);
	  $path_array[] = date("m", $mail["date"]["timestamp"]);
	  $path_array[] = date("d", $mail["date"]["timestamp"]);
	  $folder = "";
	  $folder = "../".implode("/", $path_array);	 
    if(!is_dir($folder)){
      mkdir($folder, 0775, true);
    }
   
    // Creat Filename
    $filename = "";
    $filename = $mail["subject"];   
    $filename = clean_file_name($filename); 
    $pathandname = $folder."/".$filename.".html";  
    print "<p>Created Moblog <a href='$pathandname'>".$pathandname."</a></p>";
   
    //Actually writing the file
    $handle = fopen($pathandname, "w+");
    fwrite($handle, $html);
    fclose($handle);
    
    // Adding it to the nodes.xml
    $nodes = @file_get_contents("../admin/nodes.xml");
    $parts = explode("<nodes>", $nodes);
    $result = array();
    $result[] = $parts[0];
    $result[] = "<nodes>\n  ".'<node path="'.str_replace("../", "", $pathandname).'"/>';
    $result[] = $parts[1];
    $handle = fopen("../admin/nodes.xml", "w+");
    fwrite ($handle, implode("", $result));
    fclose($handle);
   
	  //print_r($html);
	  //print ("<pre>"); print_r($mail); print ("</pre>");
	}
	$email->delete_all_mail();
	print( "<p>Added ".count($email->mails)." Moblog Posts from Mails.</p>");
}else {
	print( "<p>No Moblog Posts from Mails.</p>");
}
?>
