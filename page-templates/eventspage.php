<?php
/*
  Template Name: Events page
*/
get_header(); ?>

    <header class="header clearfix" id="header">
        <?php get_template_part('parts/section', 'header'); ?>
    </header>

    <div class="container page-about">
        <div id="content">
            <div class="content-holder">
                <?php $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>
                <div class="cover" style="background: url('<?php echo $thumb_img; ?>') no-repeat center / cover;">
                </div>
                <div class="content-holder">
                    <?php echo get_the_content(); ?>
                    <div class="Sign-up">
                        <div class="download-buttons">
                            <a href="https://thosecatholicmen.kindful.com/?campaign=242028" class="btn btn-blue btn-download">Make my year-end gift today!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!--/page-->
</div>

<?php get_footer(); ?>