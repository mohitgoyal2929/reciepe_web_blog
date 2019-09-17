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

    <title>Dashboard - <?php echo $website_name? $website_name : get_config('app', 'name'); ?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/dashboard/">

    <link rel="stylesheet" href="../css/bootstrap.min.css" media="all" />
    <link href="../css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index.php"><?php echo $website_name? $website_name : get_config('app', 'name'); ?></a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../logout.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-fixed pt-5">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link <?php echo isset($page_title) && $page_title === 'Dashboard'? 'active':'';?>" href="index.php">
                  <span data-feather="home"></span>
                  Dashboard <?php echo isset($page_title) && $page_title === 'Dashboard'? '<span class="sr-only">(current)</span>':'';?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo isset($page_title) && $page_title === 'Recipes'? 'active':'';?>" href="recipes.php">
                  <span data-feather="list"></span>
                  Recipes <?php echo isset($page_title) && $page_title === 'Recipes'? '<span class="sr-only">(current)</span>':'';?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo isset($page_title) && $page_title === 'Users'? 'active':'';?>" href="users.php">
                  <span data-feather="users"></span>
                  Users <?php echo isset($page_title) && $page_title === 'Users'? '<span class="sr-only">(current)</span>':'';?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo isset($page_title) && $page_title === 'Category'? 'active':'';?>" href="category.php">
                  <span data-feather="filter"></span>
                  Category <?php echo isset($page_title) && $page_title === 'Category'? '<span class="sr-only">(current)</span>':'';?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo isset($page_title) && $page_title === 'Meal Type'? 'active':'';?>" href="meal_type.php">
                  <span data-feather="file"></span>
                  Meal Type <?php echo isset($page_title) && $page_title === 'Meal Type'? '<span class="sr-only">(current)</span>':'';?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo isset($page_title) && $page_title === 'Ingredient'? 'active':'';?>" href="ingredient.php">
                  <span data-feather="file"></span>
                  Ingredient <?php echo isset($page_title) && $page_title === 'Ingredient'? '<span class="sr-only">(current)</span>':'';?>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link <?php echo isset($page_title) && $page_title === 'Slides'? 'active':'';?>" href="slides.php" >
                  <span data-feather="film"></span>
                  Slides <?php echo isset($page_title) && $page_title === 'Slides'? '<span class="sr-only">(current)</span>':'';?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo isset($page_title) && $page_title === 'Settings'? 'active':'';?>" href="settings.php">
                  <span data-feather="settings"></span>
                  Settings <?php echo isset($page_title) && $page_title === 'Settings'? '<span class="sr-only">(current)</span>':'';?>
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">