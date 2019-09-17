<?php 
  include_once '../../includes/bootstrap.php';

  delete_by_id('meal_type', $_GET['id']);
  redirect('dashboard/meal_type.php');