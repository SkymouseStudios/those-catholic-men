<?php
/*
  Template Name: Donate
*/
get_header(); ?>

        <header class="header clearfix" id="header">
            <?php get_template_part('parts/section', 'header'); ?>
        </header>

        <?php
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
        ?>
        <div class="container">
            <div id="content">
                <div class="content-holder" style="background-color: white; ">
                    <?php echo get_the_content(); ?>
                </div>
            </div>
        </div>


    </div><!--/page-->
</div>

<?php get_footer(); ?>