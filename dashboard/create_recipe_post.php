<?php
include_once '../includes/bootstrap.php';

if(!is_loggedin()) {
    redirect('../login.php');
}
$category = get_data('category');
$meal_type = get_data('meal_type');
$ingredient = get_data('ingredients');

$page_title = 'Create New Recipe';


include_once 'partials/header.php';
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2"><?php echo isset($page_title)? ucfirst($page_title): 'Dashboard'; ?></h1>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="login-form mt-1">
                <form action="operations/postmypost.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="recipe_name">Name</label>
                            <input type="text" name="name" id="recipe_name" class="form-control" autocomplete="off" autofocus="on" />
                        </div>
                        <div class="form-group">
                            <label for="serving">Serving</label>
                            <input type="number" name="serving" class="form-control" id="serving" />
                        </div>
                        <div class="form-group">
                            <label for="cooking_time">Cooking Time (Minutes)</label>
                            <input type="text" name="cooking_time" id="cooking_time" class="form-control" autocomplete="off" autofocus="on" />
                        </div>
                        <div class="form-group">
                            <label for="prep_time">Prepration Time (Minutes)</label>
                            <input type="text" name="prep_time" id="prep_time" class="form-control" autocomplete="off" autofocus="on" />
                        </div>
                        <div class="form-group">
                            <label for="ingredient">Ingredients <small class="text-muted">(press <kbd>ctr</kbd> to select multiple ingredients)<span class="ml-1"><abbr title="If ingredient is not in list"><a href="ingredient.php">Add new</a></abbr></span></small></label>
                            <select multiple name="ingredient[]" class="form-control" id="category">
                                <?php
                                foreach($ingredient as $row) {
                                    echo '<option value="'. $row["id"] .'">'.$row["name"].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">Category <small class="text-muted">(press <kbd>ctr</kbd> to select multiple categories)<span class="ml-1"><abbr title="If your category is not in list"><a href="category.php">Add new</a></abbr></span></small></label>
                            <select multiple name="category[]" class="form-control" id="category">
                                <?php
                                foreach($category as $row) {
                                    echo '<option value="'. $row["id"] .'">'.$row["name"].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="meal_type">Meal Type <small class="text-muted"><abbr title="If your meal type is not in list"><a href="meal_type.php">Add new</a></abbr></small></label>
                            <select name="meal_type" class="form-control" id="meal_type">
                                <?php
                                foreach($meal_type as $row) {
                                    echo '<option value="'. $row["id"] .'">'.$row["name"].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group py-3">
                            <label for="main_img">Select Image</label>
                            <input type="file" name="file[]" id="main_img"/>
                        </div>
                        <div class="form-group">
                            <label for="description">Detailed recipe <small class="text-muted">(You can add HTML according to bootstrap)</small></label>
                            <textarea name="description" class="form-control" id="description" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nutrition_fact">Nutrition Fact <small class="text-muted">(You can add HTML according to bootstrap)</small></label>
                            <textarea name="nutrition_fact" class="form-control" id="nutrition_fact" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once 'partials/footer.php';