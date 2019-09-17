<?php
   include_once '../includes/bootstrap.php';

    if(!is_loggedin()) {
      redirect('login.php');
    } else if(!is_admin()) {
      redirect('profile.php');
    }

    // Save Settings
    if(isset($_POST)) {
      foreach($_POST as $name => $value) {
        update_setting($name, $value);
      }
    }

    $page_title = 'Settings';
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
          <div class="form">
            <form method="POST">
              <div class="form-group">
                <label for="st_websitename">Website Name:</label>
                <input type="text" name="website_name" class="form-control" value="<?php echo get_setting('website_name');?>" id="st_websitename">
              </div>
              <div class="form-group">
                <label for="st_about">Website About:</label>
                <textarea name="website_about" class="form-control" id="st_about"><?php echo get_setting('website_about');?> </textarea>
              </div>
              <div class="form-group form-check">
                <label class="form-check-label" for="disable-reg">
                  <input type="hidden" class="" name="disable_registration" value="off" /> 
                  <input type="checkbox" class="form-check-input" name="disable_registration" id="disable-reg" <?php echo get_setting('disable_registration')==='on'? 'checked':''?> > Disable Registration:</label>
              </div>
              <div class="form-group">
                <label for="st_excerpt">Excerpt Length</label>
                <input type="text" name="excerpt_length" class="form-control" value="<?php echo get_setting('excerpt_length');?>" id="st_excerpt">
              </div>
              <div class="form-group">
                <label for="st_excerpt_search">Excerpt Length at Search Page</label>
                <input type="text" name="excerpt_length_search" class="form-control" value="<?php echo get_setting('excerpt_length_search');?>" id="st_excerpt_search">
              </div>
              <div class="form-group">
                <label for="st_fblink">Facebook:</label>
                <input type="text" name="facebook_link" class="form-control" value="<?php echo get_setting('facebook_link');?>" id="st_fblink">
              </div>
              <div class="form-group">
                <label for="st_twitter">Twitter:</label>
                <input type="text" name="twitter_link" class="form-control" value="<?php echo get_setting('twitter_link');?>" id="st_twitter">
              </div>
              <div class="form-group">
                <label for="st_insta">Instagram:</label>
                <input type="text" name="instagram_link" class="form-control" value="<?php echo get_setting('instagram_link');?>" id="st_insta">
              </div>
              <div class="form-group">
                <label for="st_pint">Pinterest:</label>
                <input type="text" name="pinterest_link" class="form-control" value="<?php echo get_setting('pinterest_link');?>" id="st_pint">
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
            </form>
          </div>
        </div>
<?php include_once 'partials/footer.php';