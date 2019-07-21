<?php
	defined('DB_SERVER') ? null : define("DB_SERVER","localhost");
	defined('DB_USER') ? null : define("DB_USER","root");		  	
	defined('DB_PASS') ? null : define("DB_PASS","");			  	
	defined('DB_NAME') ? null : define("DB_NAME","bojenishkiurvich"); 

	$thisFile = str_replace('\\', '/', __FILE__);
	$docRoot = $_SERVER['DOCUMENT_ROOT'];

	$webRoot = str_replace(array($docRoot, 'includes/config.php'), '', $thisFile);
	$srvRoot = str_replace('config/config.php','', $thisFile);

	define('WEB_ROOT', $webRoot);
	define('SRV_ROOT', $srvRoot);
?>