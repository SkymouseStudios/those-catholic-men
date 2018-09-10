<strong class="logo"><a href="<?php echo get_permalink(get_page_by_path('home')); ?>">TCM</a></strong>
<a class="btn-mob" href="#"><span></span></a>
<div class="header-holder">

    <?php
        wp_nav_menu(array(
            'container' => 'nav',
            'menu_id' => 'main-nav',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'walker' => new tcm_walker_nav_menu()
        ));

        //Social links
        $social = get_option('social_option_name');

        $fb = $social['facebook'];
        $tw = $social['twitter'];
        $youtube = $social['youtube'];
        $rss = $social['rss'];
    ?>

</div>