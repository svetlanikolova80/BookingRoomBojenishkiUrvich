<?php 
	require_once("includes/initialize.php");	
	$reservation_id = $_POST['id'];
	$mydb->setQuery("select * from reservation where reservation_id =".$reservation_id );
	$cur = $mydb->loadResultList();
	die(json_encode($cur));
?>