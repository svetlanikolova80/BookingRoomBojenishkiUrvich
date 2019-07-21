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
		
		case 'editimage':
			editImg();
			break;
		
		case 'delete':
			doDelete();
			break;
	}
	function doInsert()
	{
		if (!isset($_FILES['image']['tmp_name'])) {
			message("Не е селектирана картинка", "error");
			redirect("index.php?view=add");
		} else {
			$file = $_FILES['image']['tmp_name'];
			$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name = addslashes($_FILES['image']['name']);
			$image_size = getimagesize($_FILES['image']['tmp_name']);
			if ($image_size == FALSE) {
				message("Не е картинка", "error");
				redirect("index.php?view=add");
			} else {
				$location = "rooms/" . $_FILES["image"]["name"];
				if (file_exists($location)) {                
					message("Има вече такава картинка", "error");
					redirect("index.php?view=add");
				} else {
					move_uploaded_file($_FILES["image"]["tmp_name"], "rooms/" . $_FILES["image"]["name"]);                
					
					if ($_POST['name'] == "" OR $_POST['rmtype'] == "" OR $_POST['price'] == "") {
						$messageStats = false;
						message("Всички полета са задължителни", "error");
						redirect("index.php?view=add");
						
					} else {
						$room = new Room();
						
						$rm_name = $_POST['name'];											
						$rm_type = $_POST['rmtype'];
						$rm_price = $_POST['price'];						
						$rm_image = $location;
						
						$res = $room->find_all_room($rm_name);                   
						
						if ($res >= 1) {
							message("Името на стаята вече съществува", "error");
							redirect("index.php?view=add");
						} else {
							
							$room->typeID = $rm_type;
							$room->roomName = $rm_name;
							$room->price = $rm_price;							
							$room->roomImage = $rm_image;							
							
							$istrue = $room->create();
							if ($istrue == 1) {
								message("Нова стая - [" . $rm_name . "] е създадена", "success");
								redirect('index.php');                            
							}
						}
					}
				}
			}
		}
	}

	function doEdit()
	{
		$room = new Room();
		$rm_no = $_POST['rmNo'];
		$rm_name = $_POST['name'];		
		$rm_type = $_POST['rmtype'];
		$rm_price = $_POST['price'];
				
		$room->typeID = $rm_type;
		$room->roomName = $rm_name;
		$room->price = $rm_price;
		$room->description = $rm_description;
				
		$room->update($rm_no);
		
		message("Стаята - [" . $rm_name . "] е променена", "success");
		unset($_SESSION['id']);
		redirect('index.php');    
	}

	function doDelete()
	{
		@$id = $_POST['selector'];
		$key = count($id);
		
		for ($i = 0; $i < $key; $i++) {
			$rm = new Room();
			$rm->delete($id[$i]);
		}
		
		message("Стаята е изтрита", "info");
		redirect('index.php');
	}

	function editImg()
	{
		if (!isset($_FILES['image']['tmp_name'])) {
			message("Не е селектирана картинка", "error");
			redirect("index.php?view=list");
		} else {
			$file = $_FILES['image']['tmp_name'];
			$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name = addslashes($_FILES['image']['name']);
			$image_size = getimagesize($_FILES['image']['tmp_name']);
			
			if ($image_size == FALSE) {
				message("Не е картинка");
				redirect("index.php?view=list");
			} else {		
				$location = "rooms/" . $_FILES["image"]["name"];
								
				$rm = new Room();
				$rm_id = $_POST['id'];
				
				move_uploaded_file($_FILES["image"]["tmp_name"], "rooms/" . $_FILES["image"]["name"]);
				
				$rm->roomImage = $location;
				$rm->update($rm_id);
				
				message("Картинката е променена", "success");
				unset($_SESSION['id']);
				redirect("index.php");
			}
		}
	}

	function _deleteImage($catId)
	{
		$deleted = false;
		
		$sql = "select * from room where roomNo ";
		
		if (is_array($catId)) {
			$sql .= " in (" . implode(',', $catId) . ")";
		} else {
			$sql .= " = {$catId}";
		}
		
		$result = dbQuery($sql);
		
		if (dbNumRows($result)) {
			while ($row = dbFetchAssoc($result)) {
				extract($row);
				$deleted = @unlink($roomImage);
			}
		}		
		return $deleted;
	}
?>