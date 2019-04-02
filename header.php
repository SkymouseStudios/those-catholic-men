<?php
/**
 * The Header template for our theme
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie7" class="no-js"> <![endif]-->
<!--[if IE 8]>
<html class="ie8" class="no-js"> <![endif]-->
<!--[if IE 9]>
<html class="ie9" class="no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="telephone=no" name="format-detection">
    <title><?php
        wp_title( '|', true, 'right' );
        bloginfo( 'name' );
        ?>
    </title>

    <link rel="icon" href="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2018/01/those-catholic-men-icon-150x150.png" sizes="32x32">
    <link rel="icon" href="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2018/01/those-catholic-men-icon.png" sizes="192x192">
    <link href="https://fonts.googleapis.com/css?family=Bitter:400,700" rel="stylesheet">

    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="google-site-verification" content="mP3cCwFXbB2lkeLBtRU4wUvYwv5c4niy0QSHlvq1bpA" />
    <link rel="alternate" type="application/rss+xml" title="Those Catholic Men Audio Blog Feed" href="itpc://pinecast.com/feed/those-catholic-men">
    
    <?php wp_head(); ?>

    <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MRSF924');</script>
    <!-- End Google Tag Manager -->

</head>
<body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MRSF924"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

<?php 
    if ( is_page('Donate') ) { 
        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
    } else { 

    } ?>

<div class="wrapper">
    <div class="content-row" style="background-size: cover; background-repeat: no-repeat; background-image: url('<?php echo $featured_img_url; ?>');">
        <div class="page">