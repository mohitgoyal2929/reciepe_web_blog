<?php 
  include_once '../../includes/bootstrap.php';

  if(create_user_by_admin()) {
    redirect('dashboard/users.php');
  }