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
    <?php wp_head();?>
</head>

<body id="top" <?php body_class(); ?>>

<header class="blog-masthead">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'exodus' ); ?></a>

    <div class="container clearfix">
        <div class="left-header">
            <?php exodus_wpml_switch(); ?>


            <form id="header-search" action="<?php bloginfo('wpurl'); ?>" method="get" _lpchecked="1">
                <input type="text" name="s" value="Search">
                <button type="submit" class="btn btn-link"><i id="search-icon" class="fa fa-search" aria-hidden="true"></i></button>
            </form>

        </div><!-- .left-header -->

        <!-- Start Site Branding -->
            <?php

            $site_title = get_bloginfo( 'name' );

            if ( is_front_page() && is_home() ) : ?>

                <h1 class="home site-title"><a href="<?php bloginfo('wpurl'); ?>"><?php echo $site_title; ?></a></h1>

            <?php else : ?>

                <p class="h1 site-title"><a href="<?php bloginfo('wpurl'); ?>"><?php echo $site_title; ?></a></p>

            <?php endif; ?>

            <div class="screen-reader-text">
                    <?php printf( esc_html__('Go to the home page of %1$s', 'exodus'), $site_title ); ?>
            </div>

        <!-- End Site Branding -->

        <div class="right-header">

            <div class="btn-group">
                <button id="account-icon" type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i id="my-account" class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <span class="sr-only">My Account</span>
                </button>

                <div id="account-menu" class="dropdown-menu dropdown-menu-right">
                    <?php wp_nav_menu( array( 'theme_location' => 'account', 'menu_class' => 'account' ) ); ?>
                </div>
            </div>
        </div><!-- .right-header -->
    </div>

    <div class="container-fluid clearfix strip">
        <nav id="site-navigation" class="main-navigation blog-nav" role="navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i id="bar-icon" class="fa fa-bars icon-border" aria-hidden="true"></i><span class="sr-only"><?php esc_html_e( 'Menu', 'exodus' ); ?></span></button>
            <?php
            wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu secondary' ) );
            ?>
        </nav><!-- #site-navigation -->
    </div>
</header>
<?php /*if ( !is_front_page() && !is_home() ) : get_template_part( 'templates/the-strip'); endif; */?>
<div class="container-fluid">
    <section id="content" class="site-content">