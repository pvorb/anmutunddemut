<?php
    require_once("heimweh.php");
    $thisyear = date("Y");
    
    
    
    if($_GET["month"]!=""){
      $selectedMonth = sanitize_text($_GET["month"]);
      $h2[] = date_number_to_month_german($selectedMonth+0);
    }elseif($_GET["year"]=="2001" and $_GET["month"]==""){
       $selectedMonth = "09";
        $_GET["month"] = "09";
        $h2[] = date_number_to_month_german(9);
    }else{
      $selectedMonth = "01";
      $_GET["month"] = "01";
      $h2[] = date_number_to_month_german(1);
    }
    
    if($_GET["year"]!=""){
      $selectedYear = sanitize_text($_GET["year"]);
      $h2[] = $selectedYear;
      $months = directory_to_array("../".$selectedYear);
    }
    
    $articles = array();
    
    if($_GET["month"]!="" and $_GET["year"]!=""){
      $docs = directory_to_array_recursive("../".$selectedYear."/".$selectedMonth);
    }
    ?>
    
    
   
    <?php
    if($selectedYear!=""){
       print "<p>";
       foreach($months as $month){?>
         <a href="javascript:ajaxManager('load_page', 'http://anmutunddemut.de/php/archiv.php?year=<?=$selectedYear?>&amp;month=<?=$month?>', 'archive')"><?=date_number_to_month_german($month+0)?></a>
       <?}
       print "</p>";      
    } 
    
    if(count($docs)>0){
      print "<h3>".implode(" ", $h2)."</h3>";
      print "<ul>";
     
      foreach($docs as $doc){
        $das = array();
        if(substr($doc, -4, 4)=="html"){
          $das = document_load($doc);
          
            if($das["title"]!=""){
              $title = $das["title"];
            }else{
              $path = str_replace("../", "", $doc);
              $title = substr($path, strrpos($path, "/")+1, strlen($path));
            }
            print "          <li>".substr(str_replace("../", "", $doc), 0, strrpos($doc, "/")-2)." <a href='".str_replace("../", BASE, $doc)."'>".$title."</a></li>\n";
          
        }
      }
      print "</ul>";
    }    