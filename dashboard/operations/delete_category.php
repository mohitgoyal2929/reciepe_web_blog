<?php 
  include_once '../../includes/bootstrap.php';

  delete_by_id('category', $_GET['id']);
  redirect('dashboard/category.php');