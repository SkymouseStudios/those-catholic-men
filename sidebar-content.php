

<div class="itunes">
<a href="https://itunes.apple.com/us/podcast/those-catholic-men/id1340543443?mt=2"><img src="http://thosecatholicmen.com/wp-content/uploads/2018/01/itunes-retina.png" alt="Subscribe on itunes"></a>
</div>

<div class="subscribe">
    <h3>Get our Newsletter</h3>
    <?php echo do_shortcode('[mc4wp_form id="127"]'); ?>
</div>

<div class="subscribe">
    <h3>Join the Movement</h3>
    <form>
        <a href="<?php echo get_permalink(get_page_by_path('donate')); ?>" class="btn">Donate</a>
    </form>
</div>

<iframe src="//rcm-na.amazon-adsystem.com/e/cm?o=1&p=11&l=ez&f=ifr&linkID=0a29b6e49db946745c6d91192fb96f6e&t=exodus90-20&tracking_id=exodus90-20" width="120" height="600" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>

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
                    <p><?php echo get_the_title();//do_excerpt(get_the_title(), 25); ?></p>
                    <span class="date"><?php the_time('m d Y') ?></span>
                </a>
            </li>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </ul>
</div>

<div class="archive">
    <h3>Archive</h3>
    <div class="form-group">
        <select id="select_year">
            <option value="years"><?php echo esc_attr( __( 'Select Year' ) ); ?></option>
            <?php wp_get_archives(array('post_type' => 'articles', 'type' => 'yearly', 'format' => 'option')); ?>
        </select>
    </div>
    <div class="form-group">
        <select id="select_month">
            <option value="months"><?php echo esc_attr( __( 'Select Month' ) ); ?></option>
        </select>
    </div>
    <button class="btn">View</button>
</div>