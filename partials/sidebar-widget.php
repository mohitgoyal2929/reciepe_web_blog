<aside class="col-md-4 side-widget">
    <?php if(isset($page_widget)) { ?> 
    <?php echo $page_widget; ?>
    <?php } ?>
    <div class="p-3 mb-3 bg-light rounded">
        <h4 class="font-italic">About</h4>
        <p class="mb-0">
        <?php
            echo get_setting('website_about');
        ?>
        </p>
    </div>

    <?php if(false) {?>
    <div class="p-3">
        <h4 class="font-italic">Archives</h4>
        <ol class="list-unstyled mb-0">
        <li><a href="#">March 2019</a></li>
        </ol>
    </div>
    <?php } ?>
    <div class="p-3 social-icon">
        <h4 class="font-italic">Elsewhere</h4>
        <ol class="list-unstyled">
        <li><a href="<?php echo get_setting('instagram_link'); ?>" target="new"><i class="fab fa-instagram"></i></a></li>
        <li><a href="<?php echo get_setting('twitter_link'); ?>" target="new"><i class="fab fa-twitter-square"></i></a></li>
        <li><a href="<?php echo get_setting('facebook_link'); ?>" target="new"><i class="fab fa-facebook-square"></i></a></li>
        <li><a href="<?php echo get_setting('pinterest_link'); ?>" target="new" target="new"><i class="fab fa-pinterest-square"></i></a></li>
        </ol>
    </div>
</aside><!-- /.blog-sidebar -->