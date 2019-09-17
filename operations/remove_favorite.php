<?php 
  include_once '../includes/bootstrap.php';

  if(remove_from_favorite()) {
    redirect('single-post.php?id='.$_GET['recipe_id']);
  }