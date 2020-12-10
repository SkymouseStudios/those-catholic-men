<?php // This is the sidebar on individual blog posts ?>

<div class="border">
    <h3>Become one of <br>Those Catholic Men</h3>
    <div id="promo"></div>
  <div class="new-subscribe">
    <?php // echo do_shortcode('[mc4wp_form id="1878"]'); ?>

    <a href="https://app.e2ma.net/app2/audience/signup/1927130/1744200/">Join our list</a>
</div>  
</div>

<div class="popular-posts">
    <h3>Recent Articles</h3>
    <ul>
        <?php
        $articles = new WP_Query(array('post_type' => 'articles', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 4));
        
        while ($articles->have_posts()) : $articles->the_post();
            $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
            ?>
            <li>
                <img src="<?php echo $thumb_img; ?>" alt="<?php echo get_the_title(); ?>">
                <a href="<?php echo get_the_permalink(); ?>">
                    <p><?php echo get_the_title(); ?></p>
                    <span class="date"><?php the_time('m d Y') ?></span>
                </a>
            </li>
        <?php 
        endwhile; wp_reset_postdata();
        ?>
    </ul>
</div>