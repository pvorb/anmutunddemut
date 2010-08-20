<?

/**
 * A File contains several global Functions
 * 
 * Most of these functions are only ocasionally used.
 * 
 * You die when your young, you die when your young!
 * 
 * @author Benjamin Birkenhake <benjamin@birkenhake.org>
 * @package Heimweh
 */

//############# Debugging Functions

function debug_var($var){
	print ("<pre>");
	ob_start();
	print_r($var);
	$output = ob_get_contents();
	ob_end_clean();
	print htmlspecialchars($output, ENT_COMPAT, "UTF-8");
	print ("</pre>\n");
}

function debug_str($var){
	print "<pre>$var</pre>\n";
}

function debug($mixed){
	if(is_array($mixed)){
		debug_var($mixed);
	}else{
		debug_str($mixed);
	}
}




// ######### Sanitization Tools

function sanitize_text($text){
	$clean = stripslashes(strip_tags($text, "<a><i><b><em><strong><blockquote><q><ul><ol><li>"));
	return $clean;
}

function sanitize_array($array){
	foreach ($array as $key => $value){
		if(is_array($value)){
			$clean[$key] = sanitize_array($value);
		}else{
			$clean[$key] = sanitize_text($value);
		}
	}
	return $clean;
}

function sanitize($mixed){
	if(is_array($mixed)){
		$clean = sanitize_array($mixed);
	}else{
		$clean = sanitize_text($mixed);
	}
	return $clean;
}

// ######### Files and Directories

function directory_to_array($path){
	$array = array();
	$handle = opendir ($path);
	$counter = 0;
	while (false !== ($file = readdir ($handle))) {
		if(!($file=="." or $file==".." or substr($file, 0,1)==".")){
			$array[$counter] = $file;
			$counter++;
		}
	}
	if(count($array)){
		sort($array);
	}
	return $array;
}

function directory_to_array_recursive($path, $result = array()){
  
  $array = directory_to_array($path);
  foreach($array as $fileorfolder){
    //print "$fileorfolder";
    if(is_dir($path."/".$fileorfolder) and !($fileorfolder=="." or substr($fileorfolder, 0,1)==".")){
      //print "Folder:".$path."/".$fileorfolder."\n";
      $result = directory_to_array_recursive($path."/".$fileorfolder, $result);
    }else{
      //print "File".$path."/".$fileorfolder."\n";
      $result[$path."/".$fileorfolder] = $path."/".$fileorfolder;
    }
  }
  return $result;
  
}



function directory_get_folder_from_path($path){
  if(is_dir($path)){
    return $path;
  }elseif(is_file($path)){
    $pieces = explode("/", $path);
    array_pop($pieces);
    $folder = implode("/", $pieces);
    return $folder;
  }else{
    return false;
  }
}

// ######### String Functions

function clean_alpha_num_string($string){
	return preg_replace("/\W/",  "", $string);
}

function clean_xml_content_string($string){
	if(is_string($string)){
		$string = stripslashes($string);
		$string = strip_tags($string);
		$string = ereg_replace("<", "", $string);
		$string = ereg_replace(">", "", $string);
		$string = ereg_replace("&", "&amp;", $string);
	}
	return $string;
}

function clean_quotation_string($string){
	$string = preg_replace("/\"/", "&#34;", $string);
	$string = preg_replace("/\'/", "&#39;", $string);
	return $string;
}

function clean_strip_quotations($string){
	$string = preg_replace("/\"/", "", $string);
	$string = preg_replace("/\'/", "", $string);
	return $string;
}

function clean_replace_umlaute($string){
	if(is_string($string)){
		$string = preg_replace("/Ö/", "Oe", $string);
		$string = preg_replace("/Ä/", "Ae", $string);
		$string = preg_replace("/Ü/", "Ue", $string);
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
	}
	return $string;
}

function clean_replace_xmlentities($string){
	if(is_string($string)){
		$string = preg_replace("/&/", "", $string);
		$string = preg_replace("/</", "", $string);
		$string = preg_replace("/>/", "", $string);
	}
	return $string;
}

function clean_ascii_string($string){
	if(is_string($string)){
		$string = clean_replace_xmlentities($string);
		$string = clean_replace_umlaute($string);
		$string = preg_replace("/\s/",  "_", $string);
		$string = preg_replace("/\W/",  "", $string);
		$string = preg_replace("/_/",  " ", $string);
	}
	return $string;
}

function clean_file_name($string){
	if(is_string($string)){
		$string = clean_replace_xmlentities($string);
		$string = clean_replace_umlaute($string);
		$string = preg_replace("/\s/",  "_", $string);
	}
	return $string;

}


function string_add_leading_zeros($string, $n){
	$null = "0";
	for($i=1; $i<=$n; $i++){
		$add = $add.$null;
	}
	return substr($add.$string, $n*-1);
}

function string_get_string_between($start, $end, $haystack){
  $pieces = array();
  
  $pieces = explode($start, $haystack);  
  if(count($pieces)==1){
    //print_r($start.$end);
    //print $haystack;
  }
  $rest   = $pieces[1];   
  
  $pieces = explode($end, $rest);
  return $pieces[0];
}

/**
 * This function converts line breaks into <p> and <br> in an intelligent fashion.
 * 
 * Based on: http://drupal.org
 * Based on: http://photomatt.net/scripts/autop
 * 
 * Standing on the shoulders of giants
 * 
 * @param string $text // The text to be autoparagraphed
 * @return string // Autoparagraphed text
 */
function string_autop($text) {
	// All block level tags
	$block = '(?:table|thead|tfoot|caption|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|blockquote|address|p|h[1-6]|hr)';

	// Split at <pre>, <script>, <style> and </pre>, </script>, </style> tags.
	// We don't apply any processing to the contents of these tags to avoid messing
	// up code. We look for matched pairs and allow basic nesting. For example:
	// "processed <pre> ignored <script> ignored </script> ignored </pre> processed"
	$chunks = preg_split('@(</?(?:pre|script|style|object)[^>]*>)@i', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
	// Note: PHP ensures the array consists of alternating delimiters and literals
	// and begins and ends with a literal (inserting NULL as required).
	$ignore = FALSE;
	$ignoretag = '';
	$output = '';
	foreach ($chunks as $i => $chunk) {
		if ($i % 2) {
			// Opening or closing tag?
			$open = ($chunk[1] != '/');
			list($tag) = split('[ >]', substr($chunk, 2 - $open), 2);
			if (!$ignore) {
				if ($open) {
					$ignore = TRUE;
					$ignoretag = $tag;
				}
			}
			// Only allow a matching tag to close it.
			else if (!$open && $ignoretag == $tag) {
				$ignore = FALSE;
				$ignoretag = '';
			}
		}
		else if (!$ignore) {
			$chunk = preg_replace('|\n*$|', '', $chunk) ."\n\n"; // just to make things a little easier, pad the end
			$chunk = preg_replace('|<br />\s*<br />|', "\n\n", $chunk);
			$chunk = preg_replace('!(<'. $block .'[^>]*>)!', "\n$1", $chunk); // Space things out a little
			$chunk = preg_replace('!(</'. $block .'>)!', "$1\n\n", $chunk); // Space things out a little
			$chunk = preg_replace("/\n\n+/", "\n\n", $chunk); // take care of duplicates
			$chunk = preg_replace('/\n?(.+?)(?:\n\s*\n|\z)/s', "<p>$1</p>\n", $chunk); // make paragraphs, including one at the end
			$chunk = preg_replace('|<p>\s*</p>\n|', '', $chunk); // under certain strange conditions it could create a P of entirely whitespace
			$chunk = preg_replace("|<p>(<li.+?)</p>|", "$1", $chunk); // problem with nested lists
			$chunk = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $chunk);
			$chunk = str_replace('</blockquote></p>', '</p></blockquote>', $chunk);
			$chunk = preg_replace('!<p>\s*(</?'. $block .'[^>]*>)!', "$1", $chunk);
			$chunk = preg_replace('!(</?'. $block .'[^>]*>)\s*</p>!', "$1", $chunk);
			$chunk = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $chunk); // make line breaks
			$chunk = preg_replace('!(</?'. $block .'[^>]*>)\s*<br />!', "$1", $chunk);
			$chunk = preg_replace('!<br />(\s*</?(?:p|li|div|th|pre|td|ul|ol)>)!', '$1', $chunk);
			$chunk = preg_replace('/&([^#])(?![A-Za-z0-9]{1,8};)/', '&amp;$1', $chunk);
		}
		$output .= $chunk;
	}
	return $output;
}

function date_strtotime_german($date){
  $array = explode(". ", $date);
  return $array;
}

function date_number_to_month_english($number){
  $months[1] = "January";
  $months[2] = "Febuary";
  $months[3] = "March";
  $months[4] = "April";
  $months[5] = "May";
  $months[6] = "June";
  $months[7] = "July";
  $months[8] = "August";
  $months[9] = "September";
  $months[10] = "October";
  $months[11] = "November";
  $months[12] = "December";
  return $months[$number];
}


//############# Object Functions


/**
 * Returns all ancestors of a given class
 *
 * @param object $class   // Any given Object
 * @return array $classes // a numeric array containing all ancestors
 */
function object_get_ancestors ($class) {
	for ($classes[] = $class; $class = get_parent_class ($class); $classes[] = $class);
	return $classes;
}

/**
 * Test if one class is an subclass of a given class
 *
 *
 * @param string $descendant  	//name of the possivle subclass
 * @param string $ancestor		//name of the possible superclass
 * @return bool
 */
function object_is_subclass($descendant, $ancestor){
	$ancestors = get_ancestors($descendant);
	if(in_array($ancestor, $ancestors)){
		return true;
	}else{
		return false;
	}
}




// ############# Array Functions

function array_literalArray2numericArray($literalArray){
	$numericArray = array();
	foreach ($literalArray as $entry){
		$numericArray[] = $entry;
	}
	return $numericArray;
}



// ############# XML Functions

function xml_is_wellformed($string){
	$xml = @simplexml_load_string($string);
	if(get_class($xml)!="SimpleXMLElement"){
		return false;
	}else{
		return true;
	}
}

// ############# Server Variables Functions

function env_get_base(){
	return ereg_replace("index.php", "", 	$_SERVER["SCRIPT_NAME"]);
}

// ############# HTTP-Funtkionen ######################################

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
