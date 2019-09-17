<?php 
  include_once '../includes/bootstrap.php';

  if(rate_recipe()) {
    redirect('single-post.php?id='.$_POST['recipe_id']);
  }