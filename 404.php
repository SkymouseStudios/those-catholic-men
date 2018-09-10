<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package tcm
 */

get_header(); ?>

<header class="header clearfix" id="header">
    <?php get_template_part('parts/section', 'header'); ?>
</header>

<div class="container">
    <div id="content">
        <div class="content-holder">
            <div class="error-content">
                <h1>Error</h1>
                <h2>404</h2>
                <p>The page you're looking for cannot be found.</p>
                <p>Please visit our <a href="<?php echo get_permalink(get_page_by_path('home')); ?>" title="Home page">Home page</a></p>
            </div>
        </div>
    </div>
</div>

</div><!--/page-->
</div>

<?php get_footer(); ?>
