<?php
	require_once("includes/initialize.php");

	$content = 'home.php';
	$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';

	switch ($view) {
		case '1' :
			$title = "Начало";	
			$content = 'home.php';		
			break;

		case '2' :
			$title = "Галерия";	
			$content ='gallery.php';
			break;
					
		case '3' :
			$title = "Стаи";	
			$content = 'rooms.php';
			break;	

		case '4' :
			$title = "Контакти";	
			$content ='contact.php';		
			break;

		case '5' :
			$title = "Локация";	
			$content = 'sitemap.php';
			break;
	}

	require_once ('theme/template.php');
?>
