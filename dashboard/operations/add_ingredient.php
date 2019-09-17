<?php 
  include_once '../../includes/bootstrap.php';

  if(insert_data('ingredients')) {
    redirect('dashboard/ingredient.php');
  }