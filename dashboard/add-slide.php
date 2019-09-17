<?php
   include_once '../includes/bootstrap.php';

    if(!is_loggedin()) {
      redirect('login.php');
    } else if(!is_admin()) {
    	redirect('profile.php');
    }
    // Update if Post exists
    if(isset($_POST) && !empty($_POST)) {
        if(isset($_POST['slideTitle'], $_POST['slideDescription'], $_FILES['slideImage'])) {
            if(empty($_POST['slideTitle'])) {
                $error = 'Title is missing.';
            } else if(empty($_POST['slideDescription'])) {
                $error = 'Description is missing';
            } else if(empty($_FILES['slideImage'])) {
                $error = 'Image is missing.';
            } else {
                //All Validations are okay
                $destination = 'imgs/slides/' . basename($_FILES['slideImage']['name']);
                $status  = move_uploaded_file($_FILES['slideImage']['tmp_name'], APP_PATH . $destination);
                
                if($status && add_slide($_POST['slideTitle'], $_POST['slideDescription'], '/'. $destination)) {
                    redirect('/dashboard/slides.php');
                } else {
                    $error = 'Something went wrong while inserting.';
                }
            }
        } else {
            $error = 'Fields are missing.';
        }
    }
    
    $page_title = 'Slides';
 	
 	include_once 'partials/header.php';
 ?> 
 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2"><?php echo isset($page_title)? ucfirst($page_title): 'Dashboard'; ?></h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<button class="btn btn-sm btn-outline-secondary" disabled="disabled">Add Slides</button>
                <!-- <button class="btn btn-sm btn-outline-secondary">Export</button> -->
            </div>
            <!-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button> -->
        </div>
    </div>
    <div class="content">
		<form method="POST" enctype="multipart/form-data">
            <?php if(isset($error)) { ?>
                <div class="alert alert-danger alert-dismissable">
                    <?php echo $error; ?>
                </div>
            <?php } ?>
          <div class="form-group">
            <label for="slideTitle">Title</label>
            <input type="text" name="slideTitle" id="slideTitle" class="form-control" value="" id="st_websitename">
          </div>
          <div class="form-group">
            <label for="slideDescription"> Description </label>
            <textarea name="slideDescription" id="slideDescription" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="slideImage"> Slide Image </label>
            <input type="file" name="slideImage" class="form-control" />
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
	</div>
<?php include_once 'partials/footer.php';