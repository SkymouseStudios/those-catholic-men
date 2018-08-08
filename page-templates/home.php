<?php
/*
  Template Name: Home
*/
get_header(); ?>

<div class="info-section">
    <header class="header-home clearfix" id="header">
        <?php get_template_part('parts/section', 'header'); ?>
    </header>

    <div class="cell">
        <div class="container">
            <strong class="logo-big">
                <a href="<?php get_permalink(get_page_by_path('home')); ?>">TCM Those Catholic Men by Catholic Men . For Catholic Men</a>
            </strong>
        </div>
    </div>
</div><!--/info-section-->

    <?php
    $articles = new WP_Query(array('post_type' => 'articles', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 1));
    while ($articles->have_posts()) : $articles->the_post();

        $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
        $author = get_the_author();
        ?>
        <div class="info-section post-intro" style="background-image: url(<?php echo $thumb_img; ?>)">
            <div class="cell">
                <div class="container">
                    <div class="intro-holder">
                        <span class="date"><?php the_time('m d Y') ?></span>
                        <h1><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h1>
                        <?php if (!empty($author)) : ?>
                            <strong class="name">By <?php echo $author; ?></strong>
                        <?php endif; ?>
                        <p><?php do_excerpt(get_the_content(), 350); ?></p>
                        <a href="<?php echo get_the_permalink(); ?>" class="btn">read more</a>
                    </div>
                </div>
            </div>
        </div><!--/info-section-->
    <?php
    endwhile;
    wp_reset_postdata();
    ?>



    <?php
    $bg_last_articles = rwmb_meta('home_bg_last_articles', null, get_the_ID());
    if ($bg_last_articles) {
        $thumb_bg_last_articles = wp_get_attachment_image_src($bg_last_articles, 'full');
    } ?>

    <div class="info-section">
<!--    style="background-image: url(--><?php //echo $thumb_bg_last_articles[0]; ?><!--)"-->
        <div class="cell">
            <div class="container">
<!--                <h1 class="lined">Latest Articles</h1>-->
                <!--Latest posts-->
                <div class="posts-wrap">
                    <div class="row">
                    <?php
                    $articles = new WP_Query(array('post_type' => 'articles', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 3));
                    while ($articles->have_posts()) : $articles->the_post();

                        $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                        $author = get_the_author();
                        ?>
                        <div class="lap-4">
                            <div class="post-preview">
                                <div class="post-bg" style="background-image: url(<?php echo $thumb_img; ?>);"></div>
                                <h3 class="lined"><?php the_title(); ?></h3>
                                <?php if (!empty($author)) : ?>
                                    <span>By <?php echo $author; ?></span>
                                <?php endif; ?>
                                <a href="<?php echo get_the_permalink(); ?>" class="btn">read more</a>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                    </div>
                </div>
                <a href="<?php echo get_permalink(get_page_by_path('articles')); ?>" class="btn">View more</a>
            </div>
        </div>
    </div><!--/info-section-->

    <div class="info-section social-intro" style="background-image: url(<?php echo $thumb_bg_updates[0]; ?>)">
        <div class="cell">
            <div class="container">
                <div class="intro-holder">
                    <h1 class="lined">Follow Those Catholic Men!</h1>
                    
                    <div class="clearfix">
                        <div class="social-plugin">

                        <!--  Facebook widget-->
                            <div id="fb-root"></div>
                            <script defer="defer">
                                (function(d, s, id) {
                                  var js, fjs = d.getElementsByTagName(s)[0];
                                  if (d.getElementById(id)) return;
                                  js = d.createElement(s); js.id = id;
                                  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
                                  fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
                            </script>

                            <?php
                            $info = get_option('info_site_name');
                            echo $info['facebook'];
                            ?>
                        <!--  Facebook widget-->

                        </div>
                        <div class="holder">

                            <div class="cols border">
                                
                                <div id="home-contact">
                                    <div class="user-form">
                                        <div id="promo"></div>
                                    </div>
                                    <div class="user-form">
                                        <h3 style="margin-top: 10px;">Become one of <br>Those Catholic Men</h3>
                                         <?php echo do_shortcode('[mc4wp_form id="1878"]'); ?>
                                    </div>
                                    </div>  
                                </div>
                            

                                <?php
                                //Social links
                                $social = get_option('social_option_name');

                                $fb = $social['facebook'];
                                $tw = $social['twitter'];
                                $youtube = $social['youtube'];
                                $rss = $social['rss'];
                                ?>

                            <div class="social-panel">
                                <h3>Follow us on Social Media:</h3>
                                <ul class="social-links">
                                    <li><a href="<?php echo $tw; ?>" class="icon-twitter-bird" target="_blank"></a></li>
                                    <li><a href="<?php echo $fb; ?>" class="icon-facebook" target="_blank"></a></li>
                                    <li><a href="<?php echo $youtube; ?>" class="icon-youtube-play" target="_blank"></a></li>
                                    <li><a href="<?php echo $rss; ?>" class="icon-rss" target="_blank"></a></li>
                                </ul>
                            </div>

                        </div> <!-- end holder -->
                    </div> <!-- end clearfix -->
                </div><!-- end intro-holder -->
            </div><!-- end container -->
        </div><!-- end cell -->
    </div><!--/info-section-->
</div> <!-- end content row -->
</div><!--/page-->

<!--FOOTER-->
<div class="exodus90">
    <a id="exodus90FooterBanner" href="https://exodus90.com/" target="_blank"><img style="width:100%;" src="https://thosecatholicmen.com/wp-content/uploads/2018/01/unnamed-2.png" alt="You are not a weak man. Join Exodus." /></a>
</div>

<?php get_footer(); ?>