<?php
	require_once("../includes/initialize.php");
	if (!isset($_SESSION['admin_ID'])){
		redirect('login.php');
	}
	include '/modal.php'; 
	$content='home.php';
	include 'themes/adminTemplate.php';
?>