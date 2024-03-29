<?php
	require_once("../../includes/initialize.php");
	$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

	switch ($action) {
		case 'add':
			doInsert();
			break;
		
		case 'edit':
			doEdit();
			break;
		
		case 'delete':
			doDelete();
			break;			
	}
	
	function doInsert()
	{	
		if ($_POST['name'] == "" OR $_POST['description'] == "") {
			message("Всички полета са задължителни", "error");
			redirect("index.php?view=add");
		} else {
			$rm = new Roomtype();
			$rm_name = $_POST['name'];
			$rm_desc = $_POST['description'];
			$res = $rm->find_all_roomtype($rm_name);
			
			if ($res >= 1) {
				message("Типът стая вече съществува", "error");
				redirect("index.php?view=add");
			} else {
				
				$rm->typename = $rm_name;
				$rm->Desp = $rm_desc;				
				
				$istrue = $rm->create();
				if ($istrue == 1) {
					message("Типът стая - [" . $rm_name . "] е създадена", "success");
					redirect('index.php');					
				}
			}			
		}
	}
	function doEdit()
	{
		if ($_POST['name'] == "" OR $_POST['description'] == "") {
			message("Всички полета са задължителни", "error");
			redirect("index.php?view=add");
			
		} else {			
			$rm = new Roomtype();
			$rm_id = $_POST['rmtype_id'];
			$rm_name = $_POST['name'];
			$rm_desc = $_POST['description'];
			
			$res = $rm->find_all_roomtype($rm_name);
			
			$rm->typename = $rm_name;
			$rm->Desp     = $rm_desc;
			
			$rm->update($rm_id);
			
			message("Типът стая [" . $rm_name . "] е променена", "success");
			redirect('index.php');			
		}		
	}

	function doDelete()
	{
		@$id = $_POST['selector'];
		$key = count($id);

		for ($i = 0; $i < $key; $i++) {
			$rm = new Roomtype();
			$rm->delete($id[$i]);
		}
		message("Типът стая е изтрит", "info");
		redirect('index.php');
	}
?>