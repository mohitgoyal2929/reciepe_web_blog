<?php
    include_once '../includes/bootstrap.php';

    if(!is_loggedin()) {
      redirect('login.php');
    } else if(!is_admin()) {
    	redirect('profile.php');
    }

    if(delete_slide($_GET['slide_id'])) {
        redirect('dashboard/slides.php');
    }
