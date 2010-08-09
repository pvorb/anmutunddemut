<?php

function getFavicon($url) {
    $HTTPRequest = fopen($url, 'r');
    if ($HTTPRequest) {
        stream_set_timeout($HTTPRequest, 0.1);
        $html = fread($HTTPRequest, 4096);
        $HTTPRequestData = stream_get_meta_data($HTTPRequest);
        fclose($HTTPRequest);
        if (!$HTTPRequestData['timed_out']) {
            if (preg_match('/<link[^>]+rel="(?:shortcut )?icon"[^>]+?href="([^"]+?)"/si', $html, $matches)) {
                $linkUrl = html_entity_decode($matches[1]);
                if (substr($linkUrl, 0, 1) == '/') {
                    $urlParts = parse_url($url);
                    $faviconURL = $urlParts['scheme'].'://'.$urlParts['host'].$linkUrl;
                } elseif (substr($linkUrl, 0, 7) == 'http://') {
                    $faviconURL = $linkUrl;
                } elseif (substr($url, -1, 1) == '/') {
                    $faviconURL = $url.$linkUrl;
                } else {
                    $faviconURL = $url.'/'.$linkUrl;
                }
            } else {
                $urlParts = parse_url($url);
                $faviconURL = $urlParts['scheme'].'://'.$urlParts['host'].'/favicon.ico';
            }
            $HTTPRequest = @fopen($faviconURL, 'r');
            if ($HTTPRequest) {
                stream_set_timeout($HTTPRequest, 0.1);
                $favicon = fread($HTTPRequest, 8192);
                $HTTPRequestData = stream_get_meta_data($HTTPRequest);
                fclose($HTTPRequest);
                if (!$HTTPRequestData['timed_out'] && strlen($favicon) < 8192) {
                    return $faviconURL;
                }
            }
        }
    }
	return "false";
}

print getFavicon('http://www.zeit.de/index');

?>