<?php
/**
 * The template for displaying tags pages.
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
$query_articles = new WP_Query(array('post_type' => 'articles', 'orderby' => 'id', 'order' => 'DESC', 'tax_query' => array(
    array(
        'taxonomy' => 'post_tag',
        'field'    => 'slug',
        'terms'    => $wp_query->query['tag'],
    ),
)));
$count_articles = $query_articles->post_count;
$count_articles = $count_articles == 1 ? $count_articles . " article" : $count_articles . " articles";

//Result for post type - events
$query_events = new WP_Query(array('post_type' => 'events', 'orderby' => 'id', 'order' => 'DESC', 'post_status' => 'any', 'tax_query' => array(
    array(
        'taxonomy' => 'post_tag',
        'field'    => 'slug',
        'terms'    => $wp_query->query['tag'],
    ),
)));
$count_events = $query_events->post_count;
$count_events = $count_events == 1 ? $count_events . " event" : $count_events . " events";

$all_result = $count_articles + $count_events;
?>

<div class="container">
    <div class="result-heading">
        <strong><span><?php echo $all_result; ?></span> results founded: <?php echo single_tag_title( '', false ); ?></strong>
        <div class="result-tabs">
            <ul class="tabs">
                <li class="btn btn-white btn-tab current" data-tab="articles"><?php echo $count_articles; ?></li>
                <li class="btn btn-white btn-tab" data-tab="events"><?php echo $count_events; ?></li>
            </ul>
        </div>
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

                            $author_article = rwmb_meta('article_author', null, get_the_ID());
                            ?>

                            <div class="result">
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

                        <?php endwhile;
                        wp_reset_postdata();
                    endif;
                endif;
                ?>
            </div>

            <div id="events" class="tab-content">
                <?php
                if ($count_events == 0) : ?>
                    <div class="result">
                        <h2 class="no_results">No results</h2>
                    </div>
                <?php else :
                    if ($query_events->have_posts()) :
                        while ($query_events->have_posts()): $query_events->the_post();

                            $location = rwmb_meta('event_location', null, get_the_ID());
                            ?>

                            <div class="result">
                                <h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>

                                <div class="clearfix">
                                    <div class="result-text">
                                        <p><?php do_excerpt(get_the_content(), 350); ?></p>
                                    </div>
                                    <div class="result-sign">
                                        <address class="location"><?php echo $location; ?></address>
                                        <span class="date"><?php the_time('d - M, Y - h:i A') ?></span>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile;
                        wp_reset_postdata();
                    endif;
                endif;
                ?>
            </div>

        </div>
        <div class="preloader"></div>
    </div>
</div>

</div><!--/page-->
</div>

<?php get_footer(); ?>