<?php 
  include_once 'includes/bootstrap.php';

  //If user logged in : Redirect to profile
  if(is_loggedin()) {
    redirect('profile.php');
  }

  //We will use exception handling
  try {
    if(create_user()) {
        redirect('login.php?first_time=1');
    }
  } catch(\Exception $e) {
    $errors = $e->getMessage();
  }
  include_once 'partials/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="login-form mt-5">
                <form  method="post">
                    <fieldset>
                        <legend>Register Form</legend>
                        <?php if(isset($errors)) { ?>
                            <div class="alert alert-danger alert-dismissiable">
                                <?php echo $errors; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-6">
                           		<div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" autocomplete="off" autofocus="on" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" autocomplete="off" autofocus="on" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login_user">Email Address</label>
                            <input type="text" name="login_email" id="login_email" class="form-control" autocomplete="off" autofocus="on" />
                        </div>
                        <div class="form-group">
                            <label for="login_user">Username</label>
                            <input type="text" name="login_user" id="login_user" class="form-control" autocomplete="off" autofocus="on" />
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="login_pass">Confirm Password</label>
                                    <input type="password" name="confirm_pass" id="confirm_pass" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Register</button>
                            <button class="btn btn-info">Login</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    include_once 'partials/footer.php';