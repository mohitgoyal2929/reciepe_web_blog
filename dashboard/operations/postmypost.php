<?php 
include_once '../../includes/bootstrap.php';

$recipe_id = save_post();

if($recipe_id != 0) {
    sync_category($recipe_id, $_POST['category']);
    sync_ingredient($recipe_id, $_POST['ingredient']);
    redirect('dashboard/upload_recipe_images.php?recipe_id='.$recipe_id);
}