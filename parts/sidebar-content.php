<?php // This is the sidebar on individual blog posts ?>

<div class="itunes">
    <a href="https://www.eventbrite.com/e/the-beer-option-a-farm-retreat-for-men-tickets-49853475086">
        <img style="width:100%;" src="https://thosecatholicmen.com/wp-content/uploads/2018/10/V1_WebsiteBanner_300x600.jpg" alt="The Beer Option.">
    </a>
</div>

<div class="itunes">
	<a href="https://itunes.apple.com/us/podcast/those-catholic-men/id1340543443?mt=2" onclick="dataLayer.push({'event': 'itunes-podcast-button'});"><img style="width:100%;" src="https://thosecatholicmen.com/wp-content/uploads/2018/01/itunes-retina.png" alt="Subscribe on itunes"></a>
</div>

<div class="itunes">
<a href='https://playmusic.app.goo.gl/?ibi=com.google.PlayMusic&isi=691797987&ius=googleplaymusic&apn=com.google.android.music&link=https://play.google.com/music/m/Imjtmx62jud7dkt7e2kx3wcwhpu?t%3DThoseCatholicMen.com%26pcampaignid%3DMKT-na-all-co-pr-mu-pod-16' rel='nofollow' onclick="dataLayer.push({'event': 'google-play-podcast-button'});">
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

<div id="amznCharityBanner" style="margin-bottom: 30px;"><a href="https://smile.amazon.com"><img style="width: 100%;" src="https://thosecatholicmen.com/wp-content/uploads/2018/08/amazon-smile.png" alt="Amazon Smile Banner"></a></div>

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

 <div class="exodus90 exodus90_hz">
	<a id="exodus90FooterBanner" href="https://exodus90.com/?utm_source=tcm_website&utm_medium=banner&utm_campaign=sidebar_banner" target="_blank">
       <img src="https://thosecatholicmen.com/wp-content/uploads/2018/09/logo-exodus-white-small-2.png" alt="Exodus 90 Logo">
       <h1>The Church Needs<br> Men Who Are Free.</h1>
       <div class="video-button">Watch the Video</div>
    </a>
</div>

<span class="red"></span><span class="green"></span>