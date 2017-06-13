<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php
    wp_head();
    $home_url = apply_filters( 'wpml_home_url', get_option( 'home' ) );
    if (is_home() || is_front_page()) { ?>
        <!--<script type="text/javascript" charset="utf-8">jQuery(window).load(function() {jQuery('.flexslider').flexslider();});</script>-->
    <?php }?>
</head>

<body id="top" <?php body_class(); ?>>

    <?php get_template_part('parts/sections' , 'header'); ?>

    <?php if ( !is_singular() || is_page('my-siddur')) {
        echo '<main class="page-body container-fluid page-body--archive" role="main">';
    } else {
        echo '<main class="page-body container-fluid page-body--single" role="main">';
    } ?>