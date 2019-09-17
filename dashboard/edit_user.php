<?php
include_once '../includes/bootstrap.php';

if(!is_loggedin()) {
    redirect('../login.php');
}
$data = get_data_by_id('users',$_GET['id']);

$page_title = 'Edit User';
include_once 'partials/header.php';
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2"><?php echo isset($page_title)? ucfirst($page_title): 'Dashboard'; ?></h1>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="login-form">
                <form action="operations/update_user.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />
                            
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" autocomplete="off" autofocus="on" value="<?php echo $data['first_name'] ?>" />
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" autocomplete="off" autofocus="on" value="<?php echo $data['last_name'] ?>" />
                        </div>
                        <div class="form-group">
                            <label for="login_user">Username / Email</label>
                            <input type="text" name="login_user" id="login_user" class="form-control" autocomplete="off" autofocus="on" value="<?php echo $data['username'] ?>" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="password" id="password" class="form-control" autocomplete="off" value="<?php echo $data['password'] ?>" />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="users.php" class="btn btn-info">Cancel</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once 'partials/footer.php';