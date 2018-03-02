<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tcm
 */
?>

<?php
//Social links
$social = get_option('social_option_name');
$fb = $social['facebook'];
$tw = $social['twitter'];
$youtube = $social['youtube'];
$rss = $social['rss'];

//Info site
$info = get_option('info_site_name');
$copyright = $info['copyright'];
?>

<!--FOOTER-->
<div class="exodus90">
	<a id="exodus90FooterBanner" href="https://exodus90.com/" target="_blank"><img style="width:100%;" src="https://thosecatholicmen.com/wp-content/uploads/2018/01/unnamed-2.png" alt="You are not a weak man. Join Exodus." /></a>
</div>

<footer class="footer">
    <div class="footer-holder">
        <div class="container">
            <strong class="logo">
                <a href="<?php echo get_permalink(get_page_by_path('home')); ?>">TCM</a>
            </strong>

            <div class="holder">
                <div class="footer-nav">

                    <?php
                    wp_nav_menu(array(
                        'container' => '',
                        'menu_class' => 'nav clearfix',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                    ));
                    ?>

                    <ul class="social-links clearfix">
                        <li><a href="<?php echo $fb; ?>" class="icon-facebook"  target="_blank"></a></li>
                        <li><a href="<?php echo $tw; ?>" class="icon-twitter-bird"  target="_blank"></a></li>
                        <li><a href="<?php echo $youtube; ?>" class="icon-youtube-play"  target="_blank"></a></li>
                        <li><a href="<?php echo $rss; ?>" class="icon-rss"  target="_blank"></a></li>
                    </ul>
                </div>
                <p class="copy">Copyright <?php echo date("Y"); ?> &#124; Those Catholic Men</p>
            </div>
        </div>
    </div>
</footer>



</div><!--/wrapper-->

<?php wp_footer(); ?>

</body>
</html>