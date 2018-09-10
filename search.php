<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package tcm
 */

get_header(); ?>

<header class="header clearfix" id="header">
    <?php get_template_part('parts/section', 'header'); ?>
</header>

<?php
global $wp_query;

//Result for post type - articles
$arr_id_articles = array();
$result_search_articles = searchContent(get_query_var('s'), 'articles');
foreach ($result_search_articles as $res) {
    $arr_id_articles[] = $res->ID;
}
$query_articles = new WP_Query(array('post_type' => 'articles', 'post__in' => $arr_id_articles, 'posts_per_page' => -1));
$count_articles = $query_articles->post_count;
if ($arr_id_articles) {
    $count_articles = $count_articles == 1 ? $count_articles . " article" : $count_articles . " articles";
} else {
    $count_articles = 0 . " articles";
}

//Result for post type - events
//$query_events = new WP_Query(array('post_type' => 'events', 's' => get_query_var('s'), 'post_status' => 'any', 'posts_per_page' => -1));
//$count_events = $query_events->post_count;
//$count_events = $count_events == 1 ? $count_events . " event" : $count_events . " events";
//
//$all_result = $count_articles + $count_events;

$all_result = $count_articles;
?>

<div class="container">
    <div class="result-heading">
        <strong><span><?php echo $all_result; ?></span> results founded: <?php echo get_search_query(); ?></strong>
<!--        <div class="result-tabs">-->
<!--            <ul class="tabs">-->
<!--                <li class="btn btn-white btn-tab current" data-tab="articles">--><?php //echo $count_articles; ?><!--</li>-->
<!--                <li class="btn btn-white btn-tab" data-tab="events">--><?php //echo $count_events; ?><!--</li>-->
<!--            </ul>-->
<!--        </div>-->
    </div>

    <div id="content">
        <div class="content-holder">

            <div id="articles" class="tab-content current">
                <?php
                if ($count_articles == 0) : ?>
                    <div class="result">
                        <h2>No results</h2>
                    </div>
                <?php else :
                    if ($query_articles->have_posts()) :
                        while ($query_articles->have_posts()): $query_articles->the_post();
                            $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                            $author_article = get_the_author();
                            ?>

                            <div class="result">
                                <div class="result-img" style="background-image: url(<?php echo $thumb_img; ?>);"></div>

                                <div class="text-wrapper">
                                    <h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>

                                    <div class="clearfix">
                                        <div class="result-text">
                                            <p><?php do_excerpt(get_the_content(), 350); ?></p>
                                        </div>
                                        <div class="result-sign">
                                            <?php if (!empty($author_article)) : ?>
                                                <span class="author">By <?php echo $author_article; ?></span>
                                            <?php endif; ?>
                                            <span class="date"><?php the_time('m d Y') ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile;
                        wp_reset_postdata();
                    endif;
                endif;
                ?>
            </div>

<!--            <div id="events" class="tab-content">-->
<!--                --><?php
//                if ($count_events == 0) : ?>
<!--                    <div class="result">-->
<!--                        <h2 class="no_results">No results</h2>-->
<!--                    </div>-->
<!--                --><?php //else :
//                    if ($query_events->have_posts()) :
//                        while ($query_events->have_posts()): $query_events->the_post();
//                            $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
//                            $location = rwmb_meta('event_location', null, get_the_ID());
//                            ?>
<!---->
<!--                            <div class="result">-->
<!--                                <div class="result-img" style="background-image: url(<?php //echo $thumb_img; ?>);"></div>-->

<!--                                <div class="text-wrapper">
/*                                    <h2><a href="*/<?php //echo get_the_permalink(); ?><!--">--><?php //echo get_the_title(); ?><!--</a></h2>-->
<!---->
<!--                                    <div class="clearfix">-->
<!--                                        <div class="result-text">-->
<!--                                            <p>--><?php //do_excerpt(get_the_content(), 350); ?><!--</p>-->
<!--                                        </div>-->
<!--                                        <div class="result-sign">-->
<!--                                            <address class="location">--><?php //echo $location; ?><!--</address>-->
<!--                                            <span class="date-time">--><?php //the_time('d - M, Y - h:i A') ?><!--</span>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                        --><?php //endwhile;
//                        wp_reset_postdata();
//                    endif;
//                endif;
//                ?>
<!--            </div>-->

        </div>
        <div class="preloader"></div>
    </div>
</div>

</div><!--/page-->
</div>

<?php get_footer(); ?>