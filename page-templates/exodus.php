<?php
/*
  Template Name: Exodus
*/
get_header();
?>

    <header class="header clearfix" id="header">
        <?php get_template_part('parts/section', 'header'); ?>
    </header>

    <?php
    $video = rwmb_meta('exodus_video', null, get_the_ID());
    $quotations = rwmb_meta('exodus_quotations', null, get_the_ID());
    $text = rwmb_meta('exodus_text', null, get_the_ID());
    ?>

    <div class="container">
        <div id="content">
            <div class="content-holder">
                <div class="video-wrapper">
                    <iframe src="<?php echo $video; ?>" allowfullscreen></iframe>
                </div>

                <div class="exodus-content">
                    <?php echo $quotations; ?>
                    <div class="exodus-text">
                        <?php echo $text; ?>
                    </div>

                    <div class="download-buttons">
                        <a href="<?php echo get_permalink(get_page_by_path('exodus-pdf')); ?>?view" class="btn btn-blue btn-download">View exodus</a>
                        <a href="<?php echo get_permalink(get_page_by_path('exodus-pdf')); ?>" class="btn btn-blue btn-download">Download</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!--/page-->
</div>

<?php get_footer(); ?>