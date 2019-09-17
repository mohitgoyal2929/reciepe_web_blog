<?php 
  include_once '../../includes/bootstrap.php';

  delete_by_id('users', $_GET['id']);
  redirect('dashboard/users.php');