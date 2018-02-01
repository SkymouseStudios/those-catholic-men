<?php
/*
  Template Name: Videos
*/
get_header(); ?>

    <header class="header clearfix" id="header">
        <?php get_template_part('parts/section', 'header'); ?>
    </header>

<!--    https://developers.google.com/youtube/v3/getting-started-->

    <div class="container">
        <div id="content">
            <div class="video-area">
                <?php echo do_shortcode('[ajax_load_more post_type="videos" post_status="publish" orderby="ID" posts_per_page="6" scroll_distance="50" max_pages="0"]'); ?>
            </div>
        </div>
    </div>

</div><!--/page-->
</div>

<?php get_footer(); ?>