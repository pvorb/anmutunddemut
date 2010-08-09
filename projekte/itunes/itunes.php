<title>My Itunes</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<? // Itunes Mediathek Skript ?>
<pre>
<?

// Just import the regular iTunes Mediathek Export XML File
// Be sure to have a good Hoster. My Mediathek.xml is about 6.5 MB.

$xml = simplexml_load_file("Mediathek.xml");

foreach ($xml as $key1 => $value1) {
	//print $key1."\n";
	foreach ($value1 as $key2 => $value2) {
		//print $key2."\n";
		foreach ($value2 as $key3 => $value3) {
			//print $key2."\n";
			foreach ($value3 as $key4 => $value4) {
				//print "[".$lastkey."]\n";

				switch ($lastkey){

					case "Artist":
						$artists["".$value4.""]="".$value4."";
						break;

					case "Album":
						$albums["".$value4.""]="".$value4."";
						break;

					case "Name":
						$tracks["".$value4.""]="".$value4."";
						break;

					case "Genre":
						$genres["".$value4.""]="".$value4."";
						break;
				}

				if($key4 == "key"){
					$lastkey = "".$value4."";
				}else{
					$lastkey = "";
				}				
			}
			$lastkey =="";
		}
	}
}
print "Benjamins Mediathek contains ";
print (count($artists))." Artists, who created ";
print (count($albums))." Albums with ";
print (count($tracks))." Tracks in ";
print (count($genres))." Genres";
print "\n";
print "Genres: \n";
print_r($genres);
print "Artists: \n";
print_r($artists);
print "Albums: \n";
print_r($albums);
print "Tracks: \n";
print_r($tracks);

?>
</pre>