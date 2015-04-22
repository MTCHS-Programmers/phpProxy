<?php
	$siteDOM = new DOMDocument();
	$siteDOM->loadHTML($siteHTML);
	
	setHref('a');
	setHref('link');
	setSrc('img');
	setSrc('script');
	include_once(getRootDir() . 'phpProxy/src/php/injectMenu.php');
	$siteHTML = $siteDOM->saveHTML();
	
	//takes care of inclide css and js
	include_once(getRootDir() . 'phpProxy/src/php/loadCSS.php');
	include_once(getRootDir() . 'phpProxy/src/php/loadJS.php');
	
	function setHref($type) {
		global $siteDOM, $url;
		$domain = 'http://' . parse_url($url, PHP_URL_HOST);
		
		$elements = $siteDOM->getElementsByTagName($type);
		foreach($elements as $element) {
			$href = $element->getAttribute('href');
			if($href != '') {
				if(substr($href, 0, 4) == 'http') {
					//Do Nothing
					$element->setAttribute('href', '?url=' . urlencode($href));
					$element->setAttribute('loadType', 1);
				}
				elseif(substr($href, 0, 2) == '//') {
					//Do Nothing save for http
					$element->setAttribute('href', '?url=' . urlencode('http:' . $href));
					$element->setAttribute('loadType', 2);
				}
				elseif(substr($href, 0, 1) != '/') {
					//Add URL to front of HREF
					$element->setAttribute('href', '?url=' . urlencode($url . '/' . $href));
					$element->setAttribute('loadType', 3);
				}
				elseif(substr($href, 0, 1) == '#') {
					//Add URL to front of HREF
					$element->setAttribute('href', '?url=' . urlencode($url . $href));
					$element->setAttribute('loadType', 4);
				}
				else {
					//Get Domain of URL and add to front of HREF
					$element->setAttribute('href', '?url=' . urlencode($domain . $href));
					$element->setAttribute('loadType', 5);
				}
			}
		}
	}
	
	function setSrc($type) {
		global $siteDOM, $url;
		$domain = 'http://' . parse_url($url, PHP_URL_HOST);
		
		$elements = $siteDOM->getElementsByTagName($type);
		foreach($elements as $element) {
			$src = $element->getAttribute('src');
			if($src != '') {
				if(substr($src, 0, 4) == 'http') {
					//Do Nothing
					$element->setAttribute('src', '?url=' . urlencode($src));
					$element->setAttribute('loadType', 1);
				}
				elseif(substr($src, 0, 2) == '//') {
					//Do Nothing save for http
					$element->setAttribute('src', '?url=' . urlencode('http:' . $src));
					$element->setAttribute('loadType', 2);
				}
				elseif(substr($src, 0, 1) != '/') {
					//Add URL to front of HREF
					$element->setAttribute('src', '?url=' . urlencode($url . '/' . $src));
					$element->setAttribute('loadType', 3);
				}
				elseif(substr($src, 0, 1) == '#') {
					//Add URL to front of HREF
					$element->setAttribute('src', '?url=' . urlencode($url . $src));
					$element->setAttribute('loadType', 4);
				}
				else {
					//Get Domain of URL and add to front of HREF
					$element->setAttribute('src', '?url=' . urlencode($domain . $src));
					$element->setAttribute('loadType', 5);
				}
			}
		}
	}
?>