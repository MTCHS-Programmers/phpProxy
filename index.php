<?php
	include_once(getRootDir() . 'phpProxy/src/php/phpProxy.php');
	echo $siteHTML;
	
	/* once the url and mimeType have been grabbed, save everything to the history database */
	include_once(getRootDir() . 'phpProxy/src/php/saveHistory.php');
	
	/* gets relative path to root dir */
	function getRootDir() {
		$curDir = $_SERVER['PHP_SELF'];
		$relDir = './';
		for($i=1; $i<substr_count($curDir, '/'); $i++) {
			$relDir .= '../';
		}
		return $relDir;
	}
?>