<?php
	require_once("../../includes/initialize.php");
	$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

	switch ($action) {
		
		case 'confirm':
			doConfirm();
			break;
		case 'cancel':
			doCancel();
			break;
		case 'checkin':
			doCheckin();
			break;
		case 'checkout':
			doCheckout();
			break;
	}

	function doCheckout()
	{   
		$id = $_GET['id'];
		
		$res = new Reservation();
		$res->status = 'Checkedout';
		$res->update($id);
		
		message("Резервацията е приключила", "success");
		redirect('index.php');    
	}

	function doCheckin()
	{
		$id = $_GET['id'];
		
		$res = new Reservation();
		$res->status = 'Checkedin';
		$res->update($id);
		
		message("Резервацията е започната", "success");
		redirect('index.php');		
	}

	function doCancel()
	{
		$id = $_GET['res_id'];
		
		$res = new Reservation();
		$res->status = 'Cancelled';
		$res->update($id);
		
		message("Резервацията е отказана", "success");
		redirect('index.php');		
	}

	function doConfirm()
	{
		$id = $_GET['res_id'];
		
		$res = new Reservation();
		$res->status = 'Confirmed';
		$res->update($id);
		
		message("Резервацията е потвърдена", "success");
		redirect('index.php');
	}

?>