<?php 
include_once 'includes/bootstrap.php';
$recipe_data = get_data_by_id('recipe', $_GET['id']);
$meal_type = get_mealType($recipe_data['meal_type_id']);
$publisher = get_data_by_id('users', $recipe_data['user_id']);
$categories = get_categories($recipe_data['id']);
if(empty($_SESSION)) {
  $isFavorite = false;
  $Rating = null;
} else {
  $Rating = get_rating_value($_SESSION['user_id'], $_GET['id']);
  $isFavorite = check_favorite($_SESSION['user_id'], $_GET['id']);
}

$nutrition_fact = !empty($recipe_data['nutrition_fact']) ? $recipe_data['nutrition_fact'] : 'No Nutrition Fact is available for this recipe.';

$page_widget = <<<EOF
<div class="p-3">
    <h4> Nutrition Fact </h4>
    <p><small> {$nutrition_fact} </small></p>
</div>
EOF;


include_once 'partials/header.php'; 
?>
  <main role="main" class="container">
    <div class="row">
      <div class="col-md-8 blog-main">
        <div class="blog-post pt-3 mb-3">
          <h2 class="blog-post-title"><?php echo  $recipe_data['name'] ?> </h2>
          <p class="blog-post-meta">
            <span><?php echo date('d-m-Y', strtotime(str_replace('-','/', $recipe_data['date']))) ?></span> by
            <span class="text-secondary">
              <?php echo strtoupper($publisher['first_name'].' '.$publisher['last_name']); ?>
            </span>
            <span class="favorite pl-2">
              <?php
              if(!$isFavorite && empty($_SESSION['user_id'])) {
                echo '<a disabled="disabled" title="Login to favorite this post"><i class="far fa-heart"></i></a>';
              } else if(!$isFavorite) {
                echo '<a href="operations/add_favorite.php?recipe_id='.$_GET['id'].'" title="Add to favorite"><i class="far fa-heart"></i></a>';
              } else { 
                echo '<a href="operations/remove_favorite.php?recipe_id='.$_GET['id'].'" title="Remove from favorite"><i class="fas fa-heart"></i></a>';
              }
              ?>
            </span>
          </p>
          <div class="col-md-12">
            <img src="<?php echo $recipe_data['main_picture'] ?>" class="img-fluid img-thumbnail rounded mx-auto d-block mb-2" alt="Recipe image">
            <table class="table table-borderless">
              <tbody>
                <tr>
                  <th scope="row">Serving</th>
                  <td><?php echo $recipe_data['serving'] ?></td>
                </tr>
                <tr>
                  <th scope="row">Cooking Time</th>
                  <td><?php echo $recipe_data['cooking_time'] ?></td>
                </tr>
                <tr>
                  <th scope="row">Preparation Time</th>
                  <td><?php echo $recipe_data['prep_time'] ?></td>
                </tr>
                <tr>
                  <th scope="row">Rating</th>
                  <td>
                    <?php
                      $avgRating = get_avg_rating($_GET['id']);
                      //displaying stars
                      $full_stars = floor($avgRating);
                      $empty_stars = 5 - $full_stars;
                      //Display full stars
                      for($i=0; $i<$full_stars ; $i++){
                        echo '<i class="fa fa-star text-warning float-left"> </i>';
                      }
                      //Display half star
                      if($avgRating - $full_stars > 0){
                        echo '<i class="fa fa-star-half-o text-warning float-left" aria-hidden="false"></i>';
                        $empty_stars --;
                      }
                      //Display empty stars
                      for($i=0; $i<$empty_stars ; $i++) {
                          echo '<i class="fa fa-star-o text-warning float-left" ></i>';
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Meal Type</th>
                  <td><?php echo $meal_type ?></td>
                </tr>
              </tbody>
            </table>
            <h2>Complete Recipe</h2>
            <p><?php echo $recipe_data['description'] ?></p>
            <p><span class="title"><strong>Category:</strong></span>
                <?php
                  foreach($categories as $key => $category) {
                      if($key==0) echo get_data_by_id('category',$category)['name'];
                      else echo ', '.get_data_by_id('category',$category)['name'];
                  };
                ?>
            </p>

            <div class="row px-3 my-5 ratings">
              <?php if (empty($Rating)) echo '<span class="rating-title">Please rate:</span>';
                else echo '<span class="rating-title">Your rating is:</span>'; ?>
              <form action="operations/rate_me.php" method="Post">
                <fieldset class="rating" <?php if (!empty($Rating)) "disabled='disabled'"; ?> >
                  <input type="hidden" name="recipe_id" value="<?php echo $_GET['id'] ?>" />
                  <input type="radio" id="star5" name="rating" value="5"  <?php if ($Rating == 5 ) echo "checked='checked'"; if(empty($Rating))echo 'onchange="this.form.submit();"'; if(empty($_SESSION['user_id'])) echo 'disabled'; ?> />
                  <label for="star5" <?php if(empty($_SESSION['user_id'])) echo 'title="Login to rate it."'; else echo 'title="Excellent"';?> >
                    5 stars
                  </label>
                  <input type="radio" id="star4" name="rating" value="4" <?php if ($Rating == 4) echo "checked='checked'"; if(empty($Rating))echo 'onchange="this.form.submit();"'; if(empty($_SESSION['user_id'])) echo 'disabled'; ?> />
                  <label for="star4" <?php if(empty($_SESSION['user_id'])) echo 'title="Login to rate it."'; else echo 'title="Good"';?> >
                    4 stars
                  </label>
                  <input type="radio" id="star3" name="rating" value="3" <?php if ($Rating == 3) echo "checked='checked'"; if(empty($Rating))echo 'onchange="this.form.submit();"'; if(empty($_SESSION['user_id'])) echo 'disabled'; ?> />
                  <label for="star3" <?php if(empty($_SESSION['user_id'])) echo 'title="Login to rate it."'; else echo 'title="Not Bad"';?> >
                    3 stars
                  </label>
                  <input type="radio" id="star2" name="rating" value="2" <?php if ($Rating == 2) echo "checked='checked'"; if(empty($Rating))echo 'onchange="this.form.submit();"'; if(empty($_SESSION['user_id'])) echo 'disabled'; ?> />
                  <label for="star2" <?php if(empty($_SESSION['user_id'])) echo 'title="Login to rate it."'; else echo 'title="Fair"';?> >
                    2 stars
                  </label>
                  <input type="radio" id="star1" name="rating" value="1" <?php if ($Rating == 1) echo "checked='checked'"; if(empty($Rating))echo 'onchange="this.form.submit();"'; if(empty($_SESSION['user_id'])) echo 'disabled'; ?> />
                  <label for="star1" <?php if(empty($_SESSION['user_id'])) echo 'title="Login to rate it."'; else echo 'title="Poor"';?> >
                    1 star
                  </label>
                </fieldset>
              </form>
            </div>
          </div>
        </div><!-- /.blog-post -->

        <?php if(false): ?>
          <nav class="blog-pagination">
          <a class="btn btn-outline-primary" href="#">Older</a>
          <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </nav>
        <?php endif; ?>
      </div><!-- /.blog-main -->

      <?php include_once 'partials/sidebar-widget.php'; ?>
    </div><!-- /.row -->
  </main><!-- /.container -->
<?php 
    include_once 'partials/footer.php';