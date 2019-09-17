<?php 
  include_once '../../includes/bootstrap.php';

  if(isset($_POST)) {
  	if(isset($_POST['name']) && empty($_POST['name'])) {
  		$error = 'Please specify the category name.';
  	} else if(isset($_POST['name']) && empty($_POST['name'])) {
  		$error = 'Invalid Update request.';
  	}
  	if(!isset($error)) {
  		$db = new Database();
  		$name = $_POST['name'];
  		$description = isset($_POST['description'])? $_POST['description']: '';
  		$category_id = $_POST['id'];

  		if(!empty($_FILES['category_image']['name'])) {
  			$image_url = 'imgs/category/'. $_FILES['category_image']['name'];
  		} else {
  			$image_url = '';
  		}
  		
  		$response = $db->insert('UPDATE category SET name = ?,description = ?, image = ? WHERE id =?', array($name, $description, $image_url, $category_id ));

  		if($response) {
  			if ($_FILES['category_image']['error'] == UPLOAD_ERR_OK) {
	            $tmp_name = $_FILES['category_image']['tmp_name'];
	            $destination_path = APP_PATH . 'imgs\\category\\' . $_FILES['category_image']['name'];
	            move_uploaded_file($tmp_name, $destination_path);
	        }
  		}
  		redirect('dashboard/category.php');
  	} else {
  		redirect('dashboard/category.php');
  	}
  	
  }