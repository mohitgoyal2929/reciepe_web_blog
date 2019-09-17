<?php
   include_once 'includes/bootstrap.php';

    //If user logged in : Redirect to profile
    if(is_loggedin()) {
        redirect('profile.php');
    }

    if(isset($_POST)) {
      $error = check_user_login();
    }

    if(isset($_GET['first_time'])) {
        $welcome = true;
    } else {
        $welcome = false;
    }
    include_once 'partials/header.php';
?>
        <main class="container content">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-form mt-5">
                        <form action="" method="POST">
                            <fieldset>
                                <legend>Login Form</legend>
                                <?php if(isset($error)) { ?>
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <?php echo $error; ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>
                                <?php } else if(isset($welcome) && $welcome) { ?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <?php echo 'Thank for registering on site. Please enter credentials again to login.'; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="login_user">Username / Email</label>
                                    <input type="text" name="login_user" id="login_user" class="form-control" autocomplete="off" autofocus="on" />
                                </div>
                                <div class="form-group">
                                    <label for="login_pass">Password</label>
                                    <input type="password" name="login_pass" id="login_pass" class="form-control" autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Login</button>
                                    <a class="btn btn-info" href="register.php">Register</a>
                                    <a class="btn btn-link text-right" href="reset-login.php">Forget Password ? </a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </main>
<?php 
    include_once 'partials/footer.php';