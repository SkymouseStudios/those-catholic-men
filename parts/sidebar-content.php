<?php // This is the sidebar on individual blog posts ?>

<div class="itunes">
	<a href="https://itunes.apple.com/us/podcast/those-catholic-men/id1340543443?mt=2"><img style="width:100%;" src="http://thosecatholicmen.com/wp-content/uploads/2018/01/itunes-retina.png" alt="Subscribe on itunes"></a>
</div>

<div class="itunes">
<a href='https://playmusic.app.goo.gl/?ibi=com.google.PlayMusic&isi=691797987&ius=googleplaymusic&apn=com.google.android.music&link=https://play.google.com/music/m/Imjtmx62jud7dkt7e2kx3wcwhpu?t%3DThoseCatholicMen.com%26pcampaignid%3DMKT-na-all-co-pr-mu-pod-16' rel='nofollow'>
    <img style="width:100%;" alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png'/>
</a>
</div>

<div class="border">
    <h3>Become one of <br>Those Catholic Men</h3>
    <div id="promo"></div>
  <div class="new-subscribe">
    <?php echo do_shortcode('[mc4wp_form id="1878"]'); ?>
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

 <div class="exodus90">
	<a href="https://exodus90.com/" target="_blank">
    <img src="http://thosecatholicmen.com/wp-content/uploads/2018/01/unnamed-3.png" alt="You are not a weak man. Join Exodus." />
  </a>
</div>