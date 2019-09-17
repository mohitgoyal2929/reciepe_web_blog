<?php 
  include_once '../../includes/bootstrap.php';

   if(insert_data('meal_type')) {
    redirect('dashboard/meal_type.php');
   }