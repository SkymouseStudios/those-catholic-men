<?php
/*
  Template Name: Donate
*/
wp_enqueue_script("tcm-donate-script", '/wp-content/plugins/gravityforms/js/gravityforms.min.js?ver=1.9.12.1', array('jquery'), null, false);
get_header(); ?>

        <header class="header clearfix" id="header">
            <?php get_template_part('parts/section', 'header'); ?>
        </header>

        <?php
            $title = rwmb_meta('donate_title', null, get_the_ID());
            $title_link1 = rwmb_meta('donate_title_link1', null, get_the_ID());
            $title_link2 = rwmb_meta('donate_title_link2', null, get_the_ID());

            $url_link1 = rwmb_meta('donate_url_link1', null, get_the_ID());
            $url_link2 = rwmb_meta('donate_url_link2', null, get_the_ID());

            $address_line1 = rwmb_meta('donate_address_line1', null, get_the_ID());
            $address_line2 = rwmb_meta('donate_address_line2', null, get_the_ID());
            $address_line3 = rwmb_meta('donate_address_line3', null, get_the_ID());
            $address_info = rwmb_meta('donate_address_info', null, get_the_ID());
        ?>

<!--        <div class="container">-->
<!--            <div id="content">-->
<!--                <div class="content-holder">-->
<!--                    <div class="donate-area">-->
<!---->
<!--                        <div class="donate">-->
<!--                            <h2>Donate like a man!</h2>-->
<!--                            --><?php //echo do_shortcode('[gravityform id="1" title="false" description="false"]'); ?>
<!--                        </div>-->
<!---->
<!--                        <div class="donate-text">-->
<!--                            --><?php //echo do_shortcode($desc); ?>
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->


        <div class="container">
            <div id="content">
                <div class="content-holder">
                    <div class="donate-title">
                        <?php echo $title; ?>
                    </div>

                    <div class="donate">
                        <div class="form-group">
                            <a href="<?php echo $url_link1; ?>" class="btn btn-white"><?php echo $title_link1; ?></a>
                        </div>
                        <div class="form-group">
                            <a href="<?php echo $url_link2; ?>" class="btn"><?php echo $title_link2; ?></a>
                        </div>
                    </div>

                    <div class="donate-info">
                        <p>To contribute by check, please mail to the following address:</p>
                        <div class="address-img"></div>
                        <address>
                            <span><?php echo $address_line1; ?></span>
                            <span><?php echo $address_line2; ?></span>
                            <span><?php echo $address_line3; ?></span>
                        </address>
                        <div class="donate-msg">
                            <?php echo $address_info; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div><!--/page-->
</div>

<?php get_footer(); ?>