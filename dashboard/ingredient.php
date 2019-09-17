<?php
   include_once '../includes/bootstrap.php';

    if(!is_loggedin()) {
      redirect('../login.php');
    }
    $data = get_data('ingredients');
    $total_posts = count($data);

    $page_title = 'Ingredient';

    include_once 'partials/header.php';
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2"><?php echo isset($page_title)? ucfirst($page_title): 'Dashboard'; ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target=".add-new-ingredient">Add Ingredient</button>
            <!-- <button class="btn btn-sm btn-outline-secondary">Export</button> -->
        </div>
        <!-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
            </button> -->
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Ingredient</th>
                    <th scope="col">Desription</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </thead>
                <tbody>
                <?php
                for($i=0; $i<$total_posts; $i++) {
                    echo '<tr>
                        <th scope="row">' . $data[$i]['name'] . '</th>
                        <td>' . $data[$i]['description'] . '</td>
                        <td>
                            <a href="edit_ingredient.php?id='. $data[$i]['id'] .'">Edit</a>
                        </td>
                        <td><a href="operations/delete_ingredient.php?id='. $data[$i]['id'] .'">Delete</a></td>
                    </tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade add-new-ingredient" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="login-form p-3">
                    <form action="operations/add_ingredient.php" method="post">
                        <fieldset>
                            <legend>Insert a new Ingredient</legend>
                            <div class="form-group">
                                <label for="category_name">Name</label>
                                <input type="text" name="name" id="category_name" class="form-control" autocomplete="off" autofocus="on" />
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" rows="6"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'partials/footer.php';