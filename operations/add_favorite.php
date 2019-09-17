<?php 
  include_once '../includes/bootstrap.php';

  if(favorite_the_recipe()) {
    redirect('single-post.php?id='.$_GET['recipe_id']);
  }