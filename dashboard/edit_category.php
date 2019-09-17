<?php
include_once '../includes/bootstrap.php';

if(!is_loggedin()) {
    redirect('../login.php');
}
$page_title = 'Edit Category';
$data = get_data_by_id('category',$_GET['id']);
include_once 'partials/header.php';
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2"><?php echo isset($page_title)? ucfirst($page_title): 'Dashboard'; ?></h1>
</div> 
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="login-form p-3">
                <form action="operations/update_category.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />

                            <label for="category_name">Name</label>
                            <input type="text" name="name" id="category_name" class="form-control" autocomplete="off" autofocus="on" value="<?php echo $data['name'] ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="6"><?php echo $data['description'] ?></textarea>
                        </div>
                         <div class="form-group">
                                <label for="category_image">Category Image</label><br />
                                <input type="file" name="category_image" id="category_image" />
                            </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a href="category.php" class="btn btn-info">Cancel</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once 'partials/footer.php';