<?php
   include_once '../includes/bootstrap.php';

    if(!is_loggedin()) {
      redirect('login.php');
    } else if(!is_admin()) {
    	redirect('profile.php');
    }

    $page_title = 'Dashboard';
?>
<?php include_once 'partials/header.php'; ?>
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2"><?php echo isset($page_title)? ucfirst($page_title): 'Dashboard'; ?></h1>
		<!-- <div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<button class="btn btn-sm btn-outline-secondary">Add Slides</button>
        <button class="btn btn-sm btn-outline-secondary">Export</button>
      </div>
      <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar"></span>
        This week
      </button>
    </div>-->
  </div>
  <div class="content">
        Welcome to the dashboard.
  </div>
<?php include_once 'partials/footer.php';