<?php 
include_once '../../includes/bootstrap.php';

img_upload($_POST['recipe_id']);
redirect('dashboard/recipes.php');