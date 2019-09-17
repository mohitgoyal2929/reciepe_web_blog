<?php 
  include_once 'includes/bootstrap.php';
  
  if(!isset($_GET['id'])) {
    die('Invalid Meal Type Page request. Please mention category id');
  }

  $mealtype_id = $_GET['id'];

  $query = 'SELECT * FROM `meal_type` WHERE `id` = '.$_GET['id'];
  
  $db = (new Database)->getConnection();
  $stmt = $db->prepare($query);
  $stmt->execute();
  $post_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
  
  if(!empty($post_ids)) {
    $query = 'SELECT * FROM recipe WHERE meal_type_id IN ('. implode(',', $post_ids).')';
    $stmt = $db->prepare($query);
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $posts = array();
  }
  $total_posts = count($posts);
  
  include_once 'partials/header.php'; 
?>
  <main role="main" class="container">
    <div class="row">
      <div class="col-md-8 blog-main">
        <div class="row mb-2">
        <?php
          if($total_posts == 0) {
            echo '<div class="p-3 mb-3">No posts found</div>';
          } else {
            while($total_posts > 0) {
              $index = $total_posts-1;
              echo '<div class="col-md-12">
                <div class="card flex-md-row mb-4 box-shadow h-md-300">
                  <div class="card-body d-flex flex-column align-items-start">
                    <strong class="d-inline-block mb-2 text-primary">' . get_data_by_id('meal_type', $posts[$index]['meal_type_id'])['name'] . '</strong>
                    <h3 class="mb-0">
                      <a class="text-dark" href="single-post.php?id=' . $posts[$index]['id'] . '">' . $posts[$index]['name'] . '</a>
                    </h3>
                    <div class="mb-1 text-muted">' . date('d-m-Y', strtotime(str_replace('-','/', $posts[$index]['date']))) . '</div>
                    <p class="card-text mb-auto">' . strip_tags(substr($posts[$index]['description'],0,get_setting('excerpt_length'))) . '... </p>
                    <a href="single-post.php?id=' . $posts[$index]['id'] . '">Continue reading</a>
                  </div>
                  <img class="card-img-right flex-auto d-none d-md-block" src="' . $posts[$index]['main_picture'] . '" alt="Card image cap">
                </div>
              </div>';
              $total_posts--;
            }  
          }
          
        ?>
        </div>
      </div><!-- /.blog-main -->

      <?php include_once 'partials/sidebar-widget.php'; ?>
    </div><!-- /.row -->
  </main><!-- /.container -->
<?php 
    include_once 'partials/footer.php';