<?php
/*
  Template Name: Contact Us
*/
get_header(); ?>

        <header class="header clearfix" id="header">
            <?php get_template_part('parts/section', 'header'); ?>
        </header>

        <div class="container">
            <div id="content">
                <div class="content-holder">
                    <div class="contacts-title">
                        <h2>Site feedback or idea?</h2>
                        <p>Share how we can improve our site.</p>
                    </div>
                    <div class="contacts">
                        <?php echo do_shortcode('[contact-form-7 id="4" title="Contact form"]'); ?>
                    </div>
                </div>
            </div>
        </div>

    </div><!--/page-->
</div>

<?php get_footer(); ?>