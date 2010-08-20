<!doctype html>
<html>
<head>
  <?php
  require_once("heimweh.php");
  $q = trim(sanitize_text($_GET["q"]));
  
  
  ?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
  <title>Suche | anmut und demut</title>
  <meta name="Generator" content="Drupal 6"/>
  <meta http-equiv="content-language" content="de" />
  <!-- Get rid of those f*ckin Bots -->
  <meta name="robots" content="noindex, nofollow" />
  <meta name="robots" content="noimageindex" />
  <meta name="googlebot" content="noindex, nofollow" />
  <meta name="DuckDuckBot" content="index, follow" />
  <meta name="description" content="anmut und demut | Kirchenlieder für die Ungläubigen seit 2001" />
  <meta name="keywords" content="Literaturwissenschaft, Philosophie, Texttechnologie, Japan, Musik, Filme, Drupal, PHP" />
  <link rel="alternate" type="application/rss+xml" title="anmut und demut RSS" href="http://anmutunddemut.de/rss.xml" />
  <link type="text/css" rel="stylesheet" media="all" href="/css/global.css" />
  <link type="text/css" rel="stylesheet" media="all" href="/css/takeshi.css" />
  <script type="text/javascript" src="/js/functions.js"> </script>
  <style type="text/css">
    
  </style>
</head>
<body  class="page-search" onload="loader();">	
  
  <div id="header" class="region">
    <!-- start:header -->  
    <h1><a title="Startseite" href="http://anmutunddemut.de">anmut und demut</a></h1> 
    <p> <a title="Impressum" href="http://anmutunddemut.de/impressum">?</a></p> 
    <!-- ende:header -->
  </div>
	
  <div id="arena" class="region">      
    <!--- start:arena -->
    
      <form id="search" method="GET" action="suche.php">
       <input id="q" type="text" name="q" value="<?=$q?>"/> <input type="submit" value="Suchen!">
      </form>

    
      <ol>
<?php


if($q!=""){
  $docs = directory_to_array_recursive("..");
  foreach($docs as $doc){
    $das = array();
    if(substr($doc, -4, 4)=="html"){
      $das = document_load($doc);
      if(stripos(strip_tags($das["source"], ""), $_GET["q"])){
        if($das["title"]!=""){
          $title = $das["title"];
        }else{
          $path = str_replace("../", "", $doc);
          $title = substr($path, strrpos($path, "/")+1, strlen($path));
        }
        print "          <li>".substr(str_replace("../", "", $doc), 0, strrpos($doc, "/")-2)." <a href='".str_replace("../", BASE, $doc)."'>".$title."</a></li>\n";
      }
    }
  }
}
?>
    </ol> 
 
 <!-- ende: arena -->  
</div>  
    
<div id="footer" class="region"> 
  <!-- start:footer -->

  <hr/>
  <p id="buttons">
    <a href="http://www.magpie-girl.com/small-is-beautiful-bloggers-manifesto/" ><img src="http://anmutunddemut.de/files/buttons/small_is_beautifull.jpg"  alt="small is beautifull" /></a>

    <a href="http://www.adfreeblog.org/"><img  src="http://anmutunddemut.de/files/buttons/art_not_ads.jpg" alt="art not ads"/></a> 
    <img  src="http://anmutunddemut.de/files/buttons/atomkraft_nein_danke.jpg" alt="atomkraft – nein danke" />
  </p>
  <hr/>
  <p id="minipressum">
    <span id="impressum">

      <a href="http://creativecommons.org/licenses/by-nc-sa/2.0/de/">cc</a> 2001 - 2010
      <a href="http://anmutunddemut.de/impressum">Benjamin Birkenhake</a>

    </span>
    <span  id="digitalistbesser" title="Rescued by Tocotronic since 1995">Digital ist besser</span>
  </p>      
  <p id="click"><img src="http://anmutunddemut.de/php/click.php" /></p>
  <!-- ende:footer -->
</div>

  
</body>
</html>