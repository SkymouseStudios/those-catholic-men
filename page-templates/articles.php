<?php
/*
  Template Name: Articles
*/
get_header(); ?>

<?php // This is the articles archive and it has the sidebar hard-coded into it ?>

<header class="header clearfix" id="header">
    <?php get_template_part('parts/section', 'header'); ?>
</header>


        <div class="container">
            <div class="sort-by">
                <span>Sort by:</span>
                <a href="<?php echo add_query_arg('order','date'); ?>" data-order="date" class="active">Latest</a>
                <a href="<?php echo add_query_arg('order','comment_count'); ?>" data-order="comment_count">Popular</a>
                <a href="<?php echo add_query_arg('order','rand'); ?>" data-order="rand">Random</a>
                <a href="<?php echo get_permalink(get_page_by_path('authors')); ?>" data-order="author">Author</a>
                <a href="<?php echo add_query_arg('order','topic'); ?>" data-order="topic">Topic</a>
            </div>

            <div class="row">
                <div class="lap-8 tab-8">
                    <div id="content">

                    <?php if ($_GET['order'] === 'topic') : ?>

                        <article id="tag-cloud">
                            <div class="tag-cloud">
                                <?php $post_types_tags = post_type_tags( 'articles' );
                                foreach( $post_types_tags as $tag ) :
                                    echo '<a href="' . get_tag_link( $tag->term_id ). '">' . esc_html( $tag->name ) . '</a>';
                                endforeach; ?>
                            </div>
                        </article>

                    <?php else : ?>

                        <div class="content-holder">

                            <?php
                            $_SESSION['do_not_duplicate_ajax_posts'] = array();
                            $args = array(
                                'post_type' => 'articles',
                                'orderby' => $_GET['order'],
                                'order' => 'DESC',
                                'post_status' => 'publish',
                                'posts_per_page' => 2,
                                'ignore_sticky_posts' => false
                            );
                            $articles = new WP_Query($args);

                            $do_not_duplicate = array();

                            if ($articles->have_posts()) : ?>

                                <?php if ($articles->max_num_pages > 1) : ?>
                                    <script>
                                        var max_pages = '<?php echo $articles->max_num_pages; ?>';
                                        var true_posts = '<?php echo serialize($articles->query_vars); ?>';
                                        var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                                    </script>
                                <?php endif; ?>

                                <?php while ($articles->have_posts()) : $articles->the_post();
                                $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                                $author_article = get_the_author();
                                $do_not_duplicate[] = get_the_ID();
                                ?>
                                    <article class="post">
                                        <img src="<?php echo $thumb_img; ?>" alt="<?php echo get_the_title(); ?>" class="article-img"/>
                                        <div class="post-content">
                                            <h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                            <div class="post-text">
                                                <p><?php do_excerpt(get_the_content(), 350); ?></p>
                                            </div>
                                            <strong class="signature">
                                                <?php if (!empty($author_article)) : ?>By <?php echo $author_article; ?> - <?php endif; ?>
                                                <span class="date"><?php the_time('m d Y') ?></span>
                                            </strong>
                                        </div>
                                    </article>
                                <?php
                                endwhile;
                                wp_reset_postdata();

                                $_SESSION['do_not_duplicate_ajax_posts'] = $do_not_duplicate;
                            endif;
                            ?>
                        </div><!--    End div.content-holder-->

                        <?php if ($articles->max_num_pages > 1) : ?>
                            <div class="alm-btn-wrap">
                                <button class="alm-load-more-btn load-more-btn">Older Posts</button>
                            </div>
                        <?php else : ?>
                            <div class="alm-btn-wrap">
                                <button class="alm-load-more-btn" style="opacity: 0;">Older Posts</button>
                            </div>
                        <?php endif;
                         ?>
                    <?php endif; ?>
                    </div>
                </div>

<div class="lap-4 tab-4"> <!-- Begin Sidebar Column -->

    <aside id="sidebar">
        <?php get_template_part('parts/sidebar-content'); ?>
    </aside>
</div> <!-- End Sidebar Column -->
           

</div> <!-- end of row -->
</div> <!-- end of container -->
    </div><!--/page-->
</div>

<div class="popups">
    <?php
    $get_id = get_page_ID_by_page_template('page-templates/home.php');

    $bg_subscribe = get_post_meta($get_id, 'home_bg_subscribe', TRUE);
    if ($bg_subscribe) {
        $thumb_bg_subscribe = wp_get_attachment_image_src($bg_subscribe, 'full');
    }

    $bg_schedule = get_post_meta($get_id, 'home_bg_schedule', TRUE);
    if ($bg_schedule) {
        $thumb_bg_schedule = wp_get_attachment_image_src($bg_schedule, 'full');
    }
    ?>

    <!--Subscribe Message Popup-->
    <div id="subscribe-msg" class="popup popup-msg">
        <img class="img-msg" src="<?php echo $thumb_bg_subscribe[0]; ?>" alt=""/>
        <a href="javascript:jQuery.fancybox.close();" class="popup-close">Close</a>
    </div>

    <!--Receive Message Popup-->
    <div id="receive-msg" class="popup popup-msg">
        <img class="img-msg" src="<?php echo $thumb_bg_schedule[0]; ?>" alt=""/>
        <a href="javascript:jQuery.fancybox.close();" class="popup-close">Close</a>
    </div>

</div>

<?php get_footer(); ?>