<?php 
  include_once '../../includes/bootstrap.php';

  delete_by_id('ingredients', $_GET['id']);
  redirect('dashboard/ingredient.php');