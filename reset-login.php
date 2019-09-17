<?php
   include_once 'includes/bootstrap.php';

    //If user logged in : Redirect to profile
    if(is_loggedin()) {
        redirect('profile.php');
    }

    if(isset($_POST)) 
    {
        if(isset($_POST['login_user'])) 
        {
            $username_or_email = $_POST['login_user'];

            $db = (new Database)->getConnection();
            //Find User in database 
            if (!filter_var($username_or_email, FILTER_VALIDATE_EMAIL)) {
                $query = 'SELECT * FROM users WHERE username = ?';
            } else {
                $query = 'SELECT * FROM users WHERE email = ?';
            }
            $stmt = $db->prepare($query);
            $stmt->execute(array($username_or_email));

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$user) {
                $error = 'Invalid Username or Email entered in field.';
            } else {
                $userEmail = $user['email'];
                $randomString = generate_string(12);
                //Update verification code in user db
                $stmt = $db->prepare('UPDATE users SET verification_code ='. $randomString .' WHERE id ='. $user['id']);
                if($stmt->execute()) {
                    $to_email = $_POST['email'];
                    $from_email = get_config('email', 'from');
                    $subject = 'Reset password was requested on recipe';
                    $message = '';
                    $headers = "From: ". $from_email;
                 
                    if (mail($to_email, $subject, $message, $headers)) {
                      echo 'Email successfully sent to $to_email...';
                    } else {
                      echo('Email sending failed...');
                    }
                }
            }
        }
    }


    include_once 'partials/header.php';
?>
        <main class="container content">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-form mt-5">
                        <form action="" method="POST">
                            <fieldset>
                                <legend>Reset Password Form</legend>
                                <?php if(isset($error)) { ?>
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <?php echo $error; ?>
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
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <a class="btn btn-info" href="login.php">Go To Login</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </main>
<?php 
    include_once 'partials/footer.php';