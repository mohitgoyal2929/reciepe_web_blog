<?php
include_once '../includes/bootstrap.php';
if(!is_loggedin()) {
    redirect('../login.php');
}
$data = get_data('recipe',' ORDER BY date DESC');
$total_posts = count($data);

$page_title = 'Recipes';
include_once 'partials/header.php';
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2"><?php echo isset($page_title)? ucfirst($page_title): 'Dashboard'; ?></h1>
    <div class="form-group">
        <a href="create_recipe_post.php" class="btn btn-sm btn-outline-secondary">Add Recipe</a>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="login-form mt-1">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Serving</th>
                            <th scope="col">Cooking/Prep Time</th>
                            <th scope="col">Ingredients</th>
                            <th scope="col">Category</th>
                            <th scope="col">Meal Type</th>
                            <th scope="col">Favorite Image</th>
                            <th scope="col">Author</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($i=0; $i<$total_posts; $i++) {
                            $ingredients = get_ingredients($data[$i]['id']);
                            $categories = get_categories($data[$i]['id']);
                            $meal_type = get_data_by_id('meal_type',$data[$i]['meal_type_id']);
                            echo '<tr>
                                <td>' . $data[$i]['name'] . '</td>
                                <td class="text-center">' . $data[$i]['serving'] . '</td>
                                <td>' . $data[$i]['cooking_time'] . ' mins / ' . $data[$i]['prep_time'] . ' mins</td>
                                <td>';
                                foreach($ingredients as $key => $ingredient) {
                                    if($key==0) echo get_data_by_id('ingredients',$ingredient)['name'];
                                    else echo ', '.get_data_by_id('ingredients',$ingredient)['name'];
                                };
                                echo '</td>
                                <td>';
                                foreach($categories as $key => $category) {
                                    if($key==0) echo get_data_by_id('category',$category)['name'];
                                    else echo ', '.get_data_by_id('category',$category)['name'];
                                };
                                echo '</td>
                                <td>' . $meal_type['name'] . '</td>
                                <td class="text-center"><img src="'. get_config('app', 'url') .'/'.$data[$i]['main_picture'].'" alt="Recipe\'s favorite image" height="50px" width="50px"></td>
                                <td>' . get_data_by_id('users',$data[$i]['user_id'])['username'] . '</td>
                                <td><a href="edit_recipe_post.php?id='. $data[$i]['id'] .'">Edit</a> <a href="operations/delete_recipe.php?id='. $data[$i]['id'] .'">Delete</a></td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include_once 'partials/footer.php';