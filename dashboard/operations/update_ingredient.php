<?php 
  include_once '../../includes/bootstrap.php';

  update_data('ingredients');
  redirect('dashboard/ingredient.php');