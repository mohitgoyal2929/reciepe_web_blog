<?php 
  include_once '../../includes/bootstrap.php';

  delete_by_id('recipe', $_GET['id']);
  redirect('dashboard/recipes.php');