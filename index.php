<?php 
  include_once 'includes/bootstrap.php';
  $posts = get_data('recipe');
  $total_posts = count($posts);
  
  $slides = get_slides();

  include_once 'partials/header.php'; 
?>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    
    <div class="carousel-inner">
      <?php if(!empty($slides)) { 
              foreach($slides as $key => $slide) { ?>
                <div class="carousel-item <?php echo $key === 0 ? 'active':''; ?>">
                  <img src="<?php echo get_config('app','url').$slide['image_url']; ?>" alt="<?php echo $slide['title']; ?>">
                  <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $slide['title']; ?></h5>
                    <p><?php echo stripslashes($slide['description']); ?></p>
                  </div>
                </div>
      <?php }
      
      } ?>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <main role="main" class="container content">
    
    <?php $categories = get_data('category'); ?>
    <?php if(!empty($categories)) { ?>
    <div class="row">
      <h1 class="font-weight-light text-center text-lg-left mt-4 mb-3">Recipe Categories</h1>
      <hr class="mt-2 mb-5">
      <div class="row text-center text-lg-left">
        <?php foreach($categories as $category) { ?>
        <div class="col-lg-3 col-md-4 col-6">
          <a href="<?php echo 'category.php?id='.$category['id']; ?>" class="d-block mb-4 h-100 text-decoration-none">
              <img class="img-fluid img-thumbnail" src="<?php echo !empty($category['image'])? $category['image']: 'imgs/placeholder.jpg'; ?>" alt="">
              <p class="text-center text-dark p-2"><?php echo $category['name']; ?> </p>
          </a>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    <div class="row">
      <div class="col-md-8 blog-main">
        <div class="row mb-2">
        <?php
        if($total_posts == 0) {
          echo '<div class="p-3 mb-3">No posts found</div>';
        }
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
        ?>

        </div>
        <!--<nav class="blog-pagination">
          <a class="btn btn-outline-primary" href="#">Older</a>
          <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </nav>-->
      </div><!-- /.blog-main -->

      <?php include_once 'partials/sidebar-widget.php'; ?>
    </div><!-- /.row -->
  </main><!-- /.container -->
<?php 
    include_once 'partials/footer.php';