<?php
	$login = array(
		'server' => 'localhost',
		'user' => 'rettoph_main',
		'password' => 'FAKE PASSWORD JACOB',
		'database' => 'rettoph_proxy'
	);
	
	//connects to the selected database
	$proxyMysqli = new mysqli($login['server'], $login['user'], $login['password'], $login['database'] );
	if ($proxyMysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		die;
	}
	
	/* now that we have been connected to the database, we must get smoe paraps */
	$sql = 'SELECT * FROM `history`;';
	$historyID = $proxyMysqli->query($sql)->num_rows;
	$userIP = $_SERVER['REMOTE_ADDR'];
	
	$sql = 'INSERT INTO `history`(`historyID`, `userID`, `url`, `type`, `ip`) VALUES ("' . $historyID . '","' . $_SESSION['userID'] . '","' . $url . '","' . $type . '","' . $userIP . '");';
	$proxyMysqli->query($sql)->num_rows;
?>