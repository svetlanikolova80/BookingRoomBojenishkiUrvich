<?php
	require_once("../includes/initialize.php");
	session_start();

	unset( $_SESSION['admin_ID'] );
	unset( $_SESSION['admin_ACCOUNT_NAME'] );
	unset( $_SESSION['admin_ACCOUNT_USERNAME'] );
	unset( $_SESSION['admin_ACCOUNT_PASSWORD'] );
	unset( $_SESSION['admin_ACCOUNT_TYPE'] );

	redirect(WEB_ROOT ."admin/index.php?logout=1");
?>