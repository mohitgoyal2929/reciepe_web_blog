<?php
   include_once '../includes/bootstrap.php';

    if(!is_loggedin()) {
      redirect('login.php');
    } else if(!is_admin()) {
    	redirect('profile.php');
    }

    $slides = get_slides();

    

    $page_title = 'Slides';
 	
 	include_once 'partials/header.php';
 ?> 
 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2"><?php echo isset($page_title)? ucfirst($page_title): 'Dashboard'; ?></h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<a href="add-slide.php" class="btn btn-sm btn-outline-secondary">Add Slides</a>
                <!-- <button class="btn btn-sm btn-outline-secondary">Export</button> -->
            </div>
            <!-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button> -->
        </div>
    </div>
    <div class="content">
		<div class="list-group">
		<?php if(!empty($slides)) { 
				foreach($slides as $slide) { ?>
					<div class="list-group-item list-group-item-action flex-column align-items-start">
						<div class="image-present">
							<img src="<?php echo get_config('app','url').$slide['image_url']; ?>" height="180px" />
						</div>
					    <div class="d-flex w-100 justify-content-between">
					      <h5 class="mb-1"><?php echo $slide['title']; ?></h5>
					      <small>3 days ago</small>
					    </div>
					    <p class="mb-1"><?php echo stripslashes($slide['description']); ?></p>
					   <!--  <small>Donec id elit non mi porta.</small> -->
					    <a href="delete-slide.php?slide_id=<?php echo $slide['id']; ?>" class="pull-right position-absolute" style="top:0; right:0">
					        <span class="btn btn-xs btn-default">
                                <span data-feather="trash-2"></span>
					            <span class="glyphicon glyphicon-play" aria-hidden="true"></span>
					        </span>
					    </a>
					  </div>

				<?php } 
			} else {
                echo 'No Slides found.';
            } ?>
		</div>
	</div>
<?php include_once 'partials/footer.php';