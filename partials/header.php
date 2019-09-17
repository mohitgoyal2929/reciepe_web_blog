<?php 
  $website_name = get_setting('website_name');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $website_name? $website_name : get_config('app', 'name'); ?></title>

   
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" href="css/main.css" media="all" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  </head>

  <body>
    <header class="blog-header container py-3 bg-dark">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
          <!--<a class="text-muted" href="#">Reciple Web Blog</a>-->
        </div>
        <div class="col-4 text-center">
          <a class="blog-header-logo text-white" href="index.php"><?php echo $website_name? $website_name : get_config('app', 'name'); ?></a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <!--<a class="text-muted" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
          </a> -->
          <?php
            include_once 'includes/bootstrap.php';
            
            if(is_loggedin()) {
              if(is_admin()) {
                echo '<a class="btn btn-sm btn-outline-secondary mr-1" href="dashboard"> Dashboard </a>';
              } else {
                echo '<a class="btn btn-sm btn-outline-secondary mr-1" href="profile.php"> Profile </a>';
              }
              echo '<a class="btn btn-sm btn-outline-secondary" href="logout.php"> Sign out </a>';
            } else {
              echo '<a class="btn btn-sm btn-outline-secondary mr-1 border-white text-white" href="login.php"> Login </a> <a class="btn btn-sm btn-outline-secondary border-white text-white" href="register.php"> Register </a>';
            }
          ?>
          
        </div>
      </div>
    </header>
    <div class="container p-0">
      <div class="">
        <nav class="nav d-flex justify-content-start navbar-dark bg-dark px-3">
          <div class="dropdown">
            <button type="button" class="btn btn-default dropdown-toggle text-white" data-toggle="dropdown">
              Recipe
            </button>
            <div class="dropdown-menu">
              <?php $meal_types = get_data('meal_type'); ?>
              <?php if(!empty($meal_types)) {?>
                <?php foreach($meal_types as $meal) { ?>
                  <a class="dropdown-item" href="<?php echo 'meal.php?id='.$meal['id']; ?>"><?php echo $meal['name']; ?></a>
                <?php } ?>
              <?php } ?>
            </div>
          </div>
          <a class="p-2 text-white" href="about.php">About</a>
          <a class="p-2 text-white" href="contact.php">Contact</a>
          <form class="form-inline my-2 my-lg-1 ml-auto" action="search.php">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><span data-feather="search"></span></button>
          </form>
        </nav>
      </div>
    </div>
    <div class="container bg-white py-4">
