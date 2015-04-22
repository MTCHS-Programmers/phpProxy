<?php
	include_once(getRootDir() . 'src/php/setup.php');
	
	/* validates that user is logged in */
	$userMessage = 'You must be logged in in order to use PHP Proxy';
	include_once(getRootDir() . 'src/php/validate.php');
	
	include_once(getRootDir() . 'phpProxy/src/php/mimeType.php');
	
	$url = ($_GET['url'] == '' ? 'http://www.mtchs.org' : str_replace(' ', '%20', $_GET['url']));
	$domain = 'http://' . parse_url($url, PHP_URL_HOST);
	
	//Find mimetype from URL
	$urlParse = parse_url($url);
	//var_dump($urlParse);
	$info = pathinfo('http://' . $urlParse['path'] . $urlParse['path']);
	$ext = strtolower ($info['extension']);
	$type = mimeTypes($ext);
	
	
	$siteHTML = file_get_contents($url);
	
	if(!isset($type) || $type == 'text/html') {
		$type = 'text/html';
		include_once(getRootDir() . 'phpProxy/src/php/loadHTML.php');
	}
	else {
		header('Content-Type: ' . $type);
		if($type == 'text/css') {
			include_once(getRootDir() . 'phpProxy/src/php/loadCSS.php');
		}
		elseif ($type == 'application/x-javascript') {
			include_once(getRootDir() . 'phpProxy/src/php/loadJS.php');
		}
		echo $siteHTML;
	}
?>