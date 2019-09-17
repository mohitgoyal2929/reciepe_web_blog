<?php
include_once '../includes/bootstrap.php';

if(!is_loggedin()) {
    redirect('../login.php');
}
include_once 'partials/header.php';
?>
<div class="row px-5">
    <div class="col-md-12">
        <div class="login-form mt-1">
            <form action="operations/upload_gallery.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Upload images of your recipe</legend>
                    <input type="hidden" name="recipe_id" value=<?php echo $_GET['recipe_id']; ?>>
                    <div class="form-group">
                        <label for="select_img">Select Images</label>
                        <input type="file" name="imgs[]" id="select_img" multiple />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php include_once 'partials/footer.php';