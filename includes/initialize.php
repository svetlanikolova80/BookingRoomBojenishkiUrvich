<?php

	defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
	defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'bojenishkiurvich');
	defined('LIB_PATH') ? null : define ('LIB_PATH',SITE_ROOT.DS.'includes');

	require_once(LIB_PATH.DS."config.php");
	require_once(LIB_PATH.DS."functions.php");
	require_once(LIB_PATH.DS."session.php");
	require_once(LIB_PATH.DS."member.php");
	require_once(LIB_PATH.DS."pagination.php");
	require_once(LIB_PATH.DS."paginsubject.php");
	require_once(LIB_PATH.DS."roomtype.php");
	require_once(LIB_PATH.DS."guest.php");
	require_once(LIB_PATH.DS."reserve.php");
	require_once(LIB_PATH.DS."database.php");

?>