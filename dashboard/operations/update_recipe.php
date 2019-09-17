<?php 
  include_once '../../includes/bootstrap.php';
  if(!empty($_FILES) && !empty($_POST)) {
    updateRecipe();
    redirect('/dashboard/recipes.php');
  }
  else {
    echo 'file is not set';
  }
  // redirect('dashboard/recipes.php');