<?php
include_once '../includes/bootstrap.php';
if(!is_loggedin()) {
    redirect('../login.php');
}
$data = get_data('users');
$total_posts = count($data);
    
    $page_title = 'Users';

include_once 'partials/header.php';
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo isset($page_title)? ucfirst($page_title): 'Dashboard'; ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target=".add-new-user">Create New User</button>
            </div>
        </div>
    </div>
    <div class="content">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Role</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                for($i=0; $i<$total_posts; $i++) {
                    echo '<tr>
                        <td>' . $data[$i]['first_name'] . '</td>
                        <td>' . $data[$i]['last_name'] . '</td>
                        <td>' . $data[$i]['username'] . '</td>
                        <td>*********</td>
                        <td>' . $data[$i]['role'] . '</td>
                        <td><a href="edit_user.php?id='. $data[$i]['id'] .'">Edit</a></td>
                        <td><a href="operations/delete_user.php?id='. $data[$i]['id'] .'">Delete</a></td>                    
                    </tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade add-new-user" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="login-form p-3">
                    <form action="operations/add_user.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" autocomplete="off" autofocus="on" />
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" autocomplete="off" autofocus="on" />
                            </div>
                            <div class="form-group">
                                <label for="login_user">Username / Email</label>
                                <input type="text" name="login_user" id="login_user" class="form-control" autocomplete="off" autofocus="on" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password" class="form-control" autocomplete="off" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Create</button>
                                <button class="btn btn-info" type="reset">Reset</button>
                                <a href="users.php" class="btn btn-primary">Cancel</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include_once 'partials/footer.php';