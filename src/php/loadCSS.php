<?php
	setCSSUrl("url('");
	setCSSUrl('url("');
	
	function setCSSUrl($string) {
		global $url , $domain, $siteHTML;
		$lastPos = 0;
		while(($lastPos = strpos($siteHTML, $string, $lastPos))!== false) {
			if(substr($siteHTML, $lastPos+strlen($string), 4) == 'http') {
				//Do Nothing
				$siteHTML = substr_replace($siteHTML, '?url=', $lastPos+strlen($string), 0);
			}
			elseif(substr($siteHTML, $lastPos+strlen($string), 1) != '/') {	
				//Add URL to front of SRC
				$siteHTML = substr_replace($siteHTML, '?url=' . $url . '/../', $lastPos+strlen($string), 0);
			}
			else {
				//Get Domain of URL and add to front of SRC
				$siteHTML = substr_replace($siteHTML, '?url=' . $domain, $lastPos+strlen($string), 0);
			}
			$lastPos = $lastPos + strlen("url('");
		}
	}
?>