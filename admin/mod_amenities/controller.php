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
			message("Не е селектирана снимка", "error");
			redirect("index.php?view=add");
		} else {
			$file = $_FILES['image']['tmp_name'];
			$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name = addslashes($_FILES['image']['name']);
			$image_size = getimagesize($_FILES['image']['tmp_name']);
			if ($image_size == FALSE) {
				message("Не е правилната снимка", "error");
				redirect("index.php?view=add");
			} else {
				$location = "pics/" . $_FILES["image"]["name"];
				if (file_exists($location)) {					
					message("Има такава картинка", "error");
					redirect("index.php?view=add");
				} else {
					move_uploaded_file($_FILES["image"]["tmp_name"], "pics/" . $_FILES["image"]["name"]);					
					
					if ($_POST['name'] == "" OR $_POST['description'] == "") {						
						message("Всички полета са задължителни", "error");
						redirect("index.php?view=add");						
					} else {
						$amen = new Amenities();						
						$amen_name   = $_POST['name'];
						$description = $_POST['description'];
						$amen_image  = $location;
						
						$res = $amen->find_all_amenities($amen_name);						
						
						if ($res >= 1) {
							message("Вече съществува", "error");
							redirect("index.php?view=add");
						} else {							
							$amen->amen_name  = $amen_name;
							$amen->amen_desp  = $description;
							$amen->amen_image = $location;
							
							$istrue = $amen->create();
							if ($istrue == 1) {
								message("Ново [" . $amen_name . "] е създадено", "success");
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
		$amen = new Amenities();
		$rm_id  = $_POST['amen_id'];
		$rm_name = $_POST['name'];
		$rm_description = $_POST['description'];
		
		$amen->amen_id   = $rm_id;
		$amen->amen_ame  = $rm_name;
		$amen->amen_desp = $rm_description;
		
		$amen->update($rm_id);
		
		message("Променено [" . $rm_name . "]", "success");
		unset($_SESSION['id']);
		redirect('index.php');
	}

	function doDelete()
	{
		@$id = $_POST['selector'];
		$key = count($id);
		
		for ($i = 0; $i < $key; $i++) {			
			$rm = new Amenities();
			$rm->delete($id[$i]);
		}
		
		message("Изтрито", "info");
		redirect('index.php');
	}
	
	function editImg()
	{
		if (!isset($_FILES['image']['tmp_name'])) {
			message("не е селектирана картинка", "error");
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
				
				$location = "pics/" . $_FILES["image"]["name"];				
				
				$amen  = new Amenities();
				$rm_id = $_POST['id'];
				
				move_uploaded_file($_FILES["image"]["tmp_name"], "pics/" . $_FILES["image"]["name"]);
				
				$amen->amen_image = $location;
				$amen->update($rm_id);
				
				message("Картинката е променена", "success");
				unset($_SESSION['id']);
				redirect("index.php");
			}
		}
	}

	function _deleteImage($catId)
	{
		$deleted = false;
		$sql = "select * from amenities where amen_id ";
		
		if (is_array($catId)) {
			$sql .= " in (" . implode(',', $catId) . ")";
		} else {
			$sql .= " = {$catId}";
		}
		global $mydb;
		$mydb->setQuery($sql);
		$cur = $mydb->executeQuery();
		
		foreach ($cur as $value) {
			$deleted = @unlink($value->amen_image);			
		}
		return $deleted;
	}
?>
