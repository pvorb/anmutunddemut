<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN">
<html>
<head>
   <title>Indexer</title>
<script type="text/javascript">
<!--
function show(id) {
 if(document.getElementById){
    if (document.getElementById(id).style.visibility == "visible"){
         document.getElementById(id).style.visibility = "hidden";
         document.getElementById(id).style.display = "none";}
    else{
         if (document.getElementById(id).style.visibility == "hidden"){
         document.getElementById(id).style.visibility = "visible";
         document.getElementById(id).style.display = ""}
      
    }
 }
}
//-->
</script>
<style type="text/css">
body {font-family:MS Sans Serif,Verdana,Arial,sans-serif; font-size:12px;}
h1 {font-size:120%;}
ul {list-style-type:none}
img {border:0px;}
a:link {text-decoration:none; color:gray; }
a:visited {text-decoration:none; color:gray; }
a:active {text-decoration:none; color:gray;}
</style>
</head>
<body>
<?php
$items = 0;

function directory2array($path){
	$handle=opendir($path);
	
	while ($file = readdir ($handle)){
	    if(substr($file, 0,1)!="." and $file!="privat"){
			  $directoryarr[]=$file;			 
			}
	}
	
	sort ($directoryarr);
  closedir($handle);
	return $directoryarr;
	
}

function dir2list($path, $level, $number){
    //DEBUGGIN
    //echo "<p>Path: ".$path."</p>";
    //echo "<p>level: ".$level."</p>";  
    
  global $items;
     
  if ($level==1){
    echo "<ul id=\"id-".$number."\" style=\"visibility:visible; display:block;\">\n";
  }else{
    echo "<ul id=\"id-".$number."\" style=\"visibility:hidden; display:none;\">\n";
  }
    $dir = directory2array($path);
   
    $counter=0;
    $end = count($dir);
    //DEBUGGIN
    //echo "<p>End: ".$end."</p>";
    if ($end == 0){
      echo "<li><em>nil</em></li>";
    }
    while ($counter< $end){
        //DEBUGGIN
        //echo "<li>".$dir[$counter]."</li>\n";
      if (is_dir($path."/".$dir[$counter])){
        $newlevel = $level+1;
        echo "<li><a href=\"javascript:show('id-".$number."-".$counter."')\"><img src=\"http://anmutunddemut.de/files/ordner.gif\" alt=\"Ordner\"/></a> ".$dir[$counter]."\n";
        $newpath = $path."/".$dir[$counter];
        //DEBUGGIN
        //echo $newpath;
        dir2list($newpath, $newlevel, $number."-".$counter);
        echo "</li>\n";
      } 
      $items ++;
      $counter++; 
    }
    
    $dir = directory2array($path);
    $counter=0;
    $end= count($dir);
    //DEBUGGIN
    //echo "<p>End: ".$end."</p>";
    while ($counter< $end){
    if(is_file($path."/".$dir[$counter]) ){
        echo"<li><img src=\"http://anmutunddemut.de/files/datei.gif\" alt=\"Ordner\"/> ".$dir[$counter];
        if (eregi(".html", $dir[$counter])
            or eregi (".xml", $dir[$counter])
            or eregi (".htm", $dir[$counter])
            or eregi (".jpg", $dir[$counter])
            or eregi (".gif", $dir[$counter])
            or eregi (".png", $dir[$counter])
            or eregi (".pdf", $dir[$counter])
            or eregi (".php", $dir[$counter])
            or eregi (".php3", $dir[$counter])
            or eregi (".css", $dir[$counter])
            or eregi (".dtd", $dir[$counter])
            or eregi (".xsd", $dir[$counter])
            or eregi (".xtm", $dir[$counter])
            or eregi (".txt", $dir[$counter])
            or eregi (".doc", $dir[$counter]) 
            or eregi (".avi", $dir[$counter])
            or eregi (".mpg", $dir[$counter])
            or eregi (".mov", $dir[$counter])
            or eregi (".mp4", $dir[$counter])
            or eregi (".mp3", $dir[$counter])
            
          ){
           echo " <a href=\"".$path."/".$dir[$counter]."\">show</a>";
          }
        echo "</li>\n";
      } 
      $items ++;
      $counter++; 
    }
    
  echo "</ul>\n";
}

//########### Hier beginnt das Skript ##################################

$startzeit = microtime();
$folder = "../../";
echo"<h1>Indexer of $folder</h1>\n";
dir2list($folder, "1", "1");



$pos1 = strpos($startzeit, " ");
$startsek = substr($startzeit, $pos1);
$startmic = substr($startzeit, 1, $pos1);
$startzeit = $startsek + $startmic;

$endzeit = microtime();
$pos2 = strpos($endzeit, " ");
$endsek = substr($endzeit, $pos1);
$endmic = substr($endzeit, 1, $pos1);
$endzeit = $endsek + $endmic;

$dauer = $endzeit - $startzeit;
$dauer = substr($dauer, 0, 6);
//echo $startzeit."<br/>";
//echo $endzeit."<br/>";
echo "<p>$items Items in :: ".$dauer." :: Seconds</p>";?>
<p>Coded in PHP and JavaScript by Benjamin Birkenhake in 2003</p>
<p>[ <a href="http://www.vox-populi.de/benjaminbirkenhake/home.php3">home</a> :: <a href="mailto:ben@vox-populi.de">mail</a> :: <a href="http://www.vox-populi.de/benjaminbirkenhake/downloads/indexer.zip">sourcecode</a> ]</p>
<p>Fell free to distribute it! Share Technology! Share Knowledge!</p>
<p>
<a href="http://validator.w3.org/">
	<img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0!"/>
</a>
<a href="http://jigsaw.w3.org/css-validator/">
	<img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!"/>
</a>
</p>
</body>
</html>