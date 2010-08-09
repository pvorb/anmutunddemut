<?php 

######### HTTP-Funtkionen ######################################

function http_request($url, $headers = array(), $method = 'GET', $data = NULL, $retry = 3) {
  global $db_prefix;

  $result = new stdClass();

  // Parse the URL and make sure we can handle the schema.
  $uri = parse_url($url);

  if ($uri == FALSE) {
    $result->error = 'unable to parse URL';
    $result->code = -1001;
    return $result;
  }

  if (!isset($uri['scheme'])) {
    $result->error = 'missing schema';
    $result->code = -1002;
    return $result;
  }

  switch ($uri['scheme']) {
    case 'http':
    case 'feed':
      $port = isset($uri['port']) ? $uri['port'] : 80;
      $host = $uri['host'] . ($port != 80 ? ':'. $port : '');
      $fp = @fsockopen($uri['host'], $port, $errno, $errstr, 15);
      break;
    case 'https':
      // Note: Only works for PHP 4.3 compiled with OpenSSL.
      $port = isset($uri['port']) ? $uri['port'] : 443;
      $host = $uri['host'] . ($port != 443 ? ':'. $port : '');
      $fp = @fsockopen('ssl://'. $uri['host'], $port, $errno, $errstr, 20);
      break;
    default:
      $result->error = 'invalid schema '. $uri['scheme'];
      $result->code = -1003;
      return $result;
  }

  // Make sure the socket opened properly.
  if (!$fp) {
    // When a network error occurs, we use a negative number so it does not
    // clash with the HTTP status codes.
    $result->code = -$errno;
    $result->error = trim($errstr);

    // Mark that this request failed. This will trigger a check of the web
    // server's ability to make outgoing HTTP requests the next time that
    // requirements checking is performed.
    // @see system_requirements()
    //variable_set('drupal_http_request_fails', TRUE);

    return $result;
  }

  // Construct the path to act on.
  $path = isset($uri['path']) ? $uri['path'] : '/';
  if (isset($uri['query'])) {
    $path .= '?'. $uri['query'];
  }

  // Create HTTP request.
  $defaults = array(
    // RFC 2616: "non-standard ports MUST, default ports MAY be included".
    // We don't add the port to prevent from breaking rewrite rules checking the
    // host that do not take into account the port number.
    'Host' => "Host: $host",
    'User-Agent' => 'User-Agent: Drupal (+http://drupal.org/)',
  );

  // Only add Content-Length if we actually have any content or if it is a POST
  // or PUT request. Some non-standard servers get confused by Content-Length in
  // at least HEAD/GET requests, and Squid always requires Content-Length in
  // POST/PUT requests.
  $content_length = strlen($data);
  if ($content_length > 0 || $method == 'POST' || $method == 'PUT') {
    $defaults['Content-Length'] = 'Content-Length: '. $content_length;
  }

  // If the server url has a user then attempt to use basic authentication
  if (isset($uri['user'])) {
    $defaults['Authorization'] = 'Authorization: Basic '. base64_encode($uri['user'] . (!empty($uri['pass']) ? ":". $uri['pass'] : ''));
  }

  // If the database prefix is being used by SimpleTest to run the tests in a copied
  // database then set the user-agent header to the database prefix so that any
  // calls to other Drupal pages will run the SimpleTest prefixed database. The
  // user-agent is used to ensure that multiple testing sessions running at the
  // same time won't interfere with each other as they would if the database
  // prefix were stored statically in a file or database variable.
  if (is_string($db_prefix) && preg_match("/^simpletest\d+$/", $db_prefix, $matches)) {
    $defaults['User-Agent'] = 'User-Agent: ' . $matches[0];
  }

  foreach ($headers as $header => $value) {
    $defaults[$header] = $header .': '. $value;
  }

  $request = $method .' '. $path ." HTTP/1.0\r\n";
  $request .= implode("\r\n", $defaults);
  $request .= "\r\n\r\n";
  $request .= $data;

  $result->request = $request;

  fwrite($fp, $request);

  // Fetch response.
  $response = '';
  while (!feof($fp) && $chunk = fread($fp, 1024)) {
    $response .= $chunk;
  }
  fclose($fp);

  // Parse response.
  list($split, $result->data) = explode("\r\n\r\n", $response, 2);
  $split = preg_split("/\r\n|\n|\r/", $split);

  list($protocol, $code, $status_message) = explode(' ', trim(array_shift($split)), 3);
  $result->protocol = $protocol;
  $result->status_message = $status_message;

  $result->headers = array();

  // Parse headers.
  while ($line = trim(array_shift($split))) {
    list($header, $value) = explode(':', $line, 2);
    if (isset($result->headers[$header]) && $header == 'Set-Cookie') {
      // RFC 2109: the Set-Cookie response header comprises the token Set-
      // Cookie:, followed by a comma-separated list of one or more cookies.
      $result->headers[$header] .= ','. trim($value);
    }
    else {
      $result->headers[$header] = trim($value);
    }
  }

  $responses = array(
    100 => 'Continue', 101 => 'Switching Protocols',
    200 => 'OK', 201 => 'Created', 202 => 'Accepted', 203 => 'Non-Authoritative Information', 204 => 'No Content', 205 => 'Reset Content', 206 => 'Partial Content',
    300 => 'Multiple Choices', 301 => 'Moved Permanently', 302 => 'Found', 303 => 'See Other', 304 => 'Not Modified', 305 => 'Use Proxy', 307 => 'Temporary Redirect',
    400 => 'Bad Request', 401 => 'Unauthorized', 402 => 'Payment Required', 403 => 'Forbidden', 404 => 'Not Found', 405 => 'Method Not Allowed', 406 => 'Not Acceptable', 407 => 'Proxy Authentication Required', 408 => 'Request Time-out', 409 => 'Conflict', 410 => 'Gone', 411 => 'Length Required', 412 => 'Precondition Failed', 413 => 'Request Entity Too Large', 414 => 'Request-URI Too Large', 415 => 'Unsupported Media Type', 416 => 'Requested range not satisfiable', 417 => 'Expectation Failed',
    500 => 'Internal Server Error', 501 => 'Not Implemented', 502 => 'Bad Gateway', 503 => 'Service Unavailable', 504 => 'Gateway Time-out', 505 => 'HTTP Version not supported'
  );
  // RFC 2616 states that all unknown HTTP codes must be treated the same as the
  // base code in their class.
  if (!isset($responses[$code])) {
    $code = floor($code / 100) * 100;
  }

  switch ($code) {
    case 200: // OK
    case 304: // Not modified
      break;
    case 301: // Moved permanently
    case 302: // Moved temporarily
    case 307: // Moved temporarily
      $location = $result->headers['Location'];

      if ($retry) {
        $result = drupal_http_request($result->headers['Location'], $headers, $method, $data, --$retry);
        $result->redirect_code = $result->code;
      }
      $result->redirect_url = $location;

      break;
    default:
      $result->error = $status_message;
  }

  $result->code = $code;
  return $result;
}





// ######### Dateisystem Funktionen

function directory2array($pfad){
	$array = array();
	$handle = opendir ($pfad);
	$counter = 0;
	while (false !== ($file = readdir ($handle))) {
		if(!($file=="." or $file=="..")){
			$array[$counter] = $file;
			$counter++;
		}
	}
	if(count($array)){
		sort($array);
	}
	return $array;
}

function make_directory($path){
  
}

// ######### Zeichenkettenfunktionen ######################################


function cleanAlphaNumString($string){
	return preg_replace("/\W/",  "", $string);
}

function cleanXMLContentString($string){
	if(is_string($string)){
		$string = stripslashes($string);
		$string = strip_tags($string);
		$string = ereg_replace("<", "", $string);
		$string = ereg_replace(">", "", $string);
		$string = ereg_replace("&", "&amp;", $string);
	}
	return $string;
}

function cleanQuotation2UnicodeString($string){
	$string = preg_replace("/\"/", "&#34;", $string);
	$string = preg_replace("/\'/", "&#39;", $string);
	return $string;
}

function cleanStripQuotations($string){
	$string = preg_replace("/\"/", "", $string);
	$string = preg_replace("/\'/", "", $string);
	return $string;
}

function cleanASCIIString($string){
	if(is_string($string)){
			$string = preg_replace("/&/", "", $string);
			$string = preg_replace("/</", "", $string);
			$string = preg_replace("/>/", "", $string);
			$string = preg_replace("/Ö/", "Oe", $string);
			$string = preg_replace("/Ä/", "Ae", $string);
			$string = preg_replace("/Ü/", "Üe", $string);
			$string = preg_replace("/ö/", "oe", $string);
			$string = preg_replace("/ä/", "ae", $string);
			$string = preg_replace("/ü/", "ue", $string);
			$string = preg_replace("/ß/", "ss", $string);
			$string = preg_replace("/É/", "E", $string);
			$string = preg_replace("/È/", "E", $string);
			$string = preg_replace("/é/", "e", $string);
			$string = preg_replace("/è/", "e", $string);
			$string = preg_replace("/Á/", "A", $string);
			$string = preg_replace("/À/", "A", $string);
			$string = preg_replace("/á/", "a", $string);
			$string = preg_replace("/à/", "a", $string);
			$string = preg_replace("/\s/",  "_", $string);
			$string = preg_replace("/\W/",  "", $string);
			$string = preg_replace("/_/",  " ", $string);
	}
	return $string;
}

function cleanFileName($string){
	if(is_string($string)){
			$string = preg_replace("/&/", "", $string);
			$string = preg_replace("/</", "", $string);
			$string = preg_replace("/>/", "", $string);
			$string = preg_replace("/Ö/", "Oe", $string);
			$string = preg_replace("/Ä/", "Ae", $string);
			$string = preg_replace("/Ü/", "Üe", $string);
			$string = preg_replace("/ö/", "oe", $string);
			$string = preg_replace("/ä/", "ae", $string);
			$string = preg_replace("/ü/", "ue", $string);
			$string = preg_replace("/ß/", "ss", $string);
			$string = preg_replace("/É/", "E", $string);
			$string = preg_replace("/È/", "E", $string);
			$string = preg_replace("/é/", "e", $string);
			$string = preg_replace("/è/", "e", $string);
			$string = preg_replace("/Á/", "A", $string);
			$string = preg_replace("/À/", "A", $string);
			$string = preg_replace("/á/", "a", $string);
			$string = preg_replace("/à/", "a", $string);
			$string = preg_replace("/\s/",  "_", $string);			
	}
	return $string;

}

function erzeugeInhaltsverzeichnis($Datei){
	$handle = fopen($Datei, "r");
	$inhaltsverzeichnis = array();
	$tocCounter = 0;
	$string = "0";
	while ($line=fgets($handle)){
		if(ereg("<h2>", $line) or
		ereg("<h3>", $line) or
		ereg("<h4>", $line) or
		ereg("<h5>", $line) or
		ereg("<h6>", $line)){
			$inhaltsverzeichnis[$tocCounter]= strip_tags($line);
			$tocCounter++;
		}
	}
	fclose($handle);
	$handle = fopen($Datei, "r");
	$tocCounter = 0;
	while ($line=fgets($handle)){
		if(ereg("<h2>", $line) or
		ereg("<h3>", $line) or
		ereg("<h4>", $line) or
		ereg("<h5>", $line) or
		ereg("<h6>", $line)){
			$line = preg_replace("/<h(\d+)>/i", "<h$1><a name='toc$tocCounter'/>", $line);
			$tocCounter++;
		}
		if(ereg("Inhaltsverzeichnis</h2>", $line)){
			$newCounter=0;
			foreach ($inhaltsverzeichnis as $eintrag){
				print "<p><a href='#toc$newCounter'>$eintrag</a></p>";
				$newCounter++;
			}
		}
		print($line);

	}
}

function addLeadingZeros($string, $n){
	$null = "0";
	for($i=1; $i<=$n; $i++){
		$add = $add.$null;
	}
	return substr($add.$string, $n*-1);
}

//#############  Suchfunktionen ######################################


function searchAndIncrease($haystack, $needle, $counter, $caseSensitivity="0"){
	if($caseSensitivity==0){
		$haystack = strtolower($haystack);
		$needle = strtolower($needle);
	}
	$hits = substr_count($haystack, $needle);
	$counter = $counter + $hits;
	return $counter;
}



//############# OO-Funktionen ######################################


/**
 * Liefert an Hand eines Objektes einer bestimmten Klasse
 * alle Vorfahrenklassen dieser Klasse zurück;
 *
 * @param object $class   // Ein beliebiges Object
 * @return array $classes // Ein numerisches Array in dem von der Elternklasse an, alle Vorfahrenklassen enthalten sind.
 */
function get_ancestors ($class) {
	for ($classes[] = $class; $class = get_parent_class ($class); $classes[] = $class);
	return $classes;
}

/**
 * Überprüft, ob eine gebene Klasse eine Unterklasse einer weiteren Klasse ist.
 *
 *
 * @param string $descendant  	//Name der möglichen Unterklasse
 * @param string $ancestor		//Name der möglichen Oberklasse	
 * @return bool
 */
function is_subclass($descendant, $ancestor){
	$ancestors = get_ancestors($descendant);
	if(in_array($ancestor, $ancestors)){
		return true;
	}else{
		return false;
	}
}




//############# Debugging Funktionen ######################################

function deBug__var($var){
	if(DEBUG){
		print ("<pre>");
		print_r($var);
		print ("</pre>\n");
	}

}

function deBug__str($var){
	if(DEBUG){
		print "<pre>$var</pre>\n";
	}

}

// ############# Array Funktionen ######################################

function literalArray2numericArray($literalArray){
	$numericArray = array();
	foreach ($literalArray as $entry){
		$numericArray[] = $entry;
	}
	return $numericArray;
}

// ############# Logging Funktionen ###################################### 



function log2DailyFile($fileType, $string){
	logFolder();
	$file = fopen(PFAD.RESOURCES_ROOT."/".STAT_FOLDER."/".$fileType."_".date("Ymd").".txt", "a+");
	fwrite($file, $string."\n");
	fclose($file);
}

function logTime2DailyFile($fileType, $string, $time){
	$leerAnzahl = 60;
	$leerZeichen = "-";
	for($i=0; $i<$leerAnzahl; $i++){
		$leerString .= $leerZeichen;
	}
	$string = $string.$leerString;
	$string = substr($string, 0,$leerAnzahl);
	$time = $time."      ";
	$time = substr($time, 0,6);
	$string = $string." ".$time." sec";
	log2DailyFile($fileType, $string);
}

function logFolder(){
	if(!is_dir(PFAD.RESOURCES_ROOT."/".STAT_FOLDER."/")){
		mkdir(PFAD.RESOURCES_ROOT."/".STAT_FOLDER."/");
	}
}



function getTime($start){
	$ende = round(microtime(true), 3);
	$start = round($start, 3);
	$time =  round($ende - $start, 3);
	// deBug__str($start." ".$ende." ".$time);
	if($time==0){
		$time = 0.001;
	}
	return $time;
}



?>