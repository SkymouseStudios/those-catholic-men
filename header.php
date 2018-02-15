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

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="google-site-verification" content="mP3cCwFXbB2lkeLBtRU4wUvYwv5c4niy0QSHlvq1bpA" />
    <link rel="alternate" type="application/rss+xml" title="Those Catholic Men Audio Blog Feed" href="itpc://pinecast.com/feed/those-catholic-men">
    
    <?php wp_head(); ?>

</head>
<body>

<div class="wrapper">
    <div class="content-row">
        <div class="page">