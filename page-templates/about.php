<?php
/*
  Template Name: About
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
                    <h1><?php echo the_title() ?></h1>
                    <blockquote>And be not conformed to this world: but be ye transformed by the renewing of your mind, that ye may prove what is that good, and acceptable, and perfect, will of God.<br>
                    Romans 12:2</blockquote>
                </div>
                <div class="content-holder">
                    <?php echo get_the_content(); ?>
                    <div class="contribute-form">
                        <?php echo do_shortcode('[contact-form-7 id="1990" title="Contributor Form"]'); ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div><!--/page-->
</div>

<?php get_footer(); ?>