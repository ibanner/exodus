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

<div class="blog-masthead">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'exodus' ); ?></a>

    <nav id="site-navigation" class="main-navigation blog-nav col-md-8" role="navigation">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'exodus' ); ?></button>
        <?php
            wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );
            wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'secondary' ) );
        ?>
    </nav><!-- #site-navigation -->
    <header class="blog-header">
        <div class="site-branding">
            <?php
            $site_title = get_bloginfo( 'name' );
            if ( is_front_page() && is_home() ) : ?>
                <h1 class="site-title"><a href="<?php bloginfo('wpurl'); ?>"><?php echo $site_title; ?></a></h1>
            <?php else : ?>
                <p class="h1 site-title"><a href="<?php bloginfo('wpurl'); ?>"><?php echo $site_title; ?></a></p>
            <?php endif; ?>
            <div class="screen-reader-text">
                    <?php printf( esc_html__('Go to the home page of %1$s', 'exodus'), $site_title ); ?>
            </div>
            <?php
            if ( is_front_page() && is_home() ) :
                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) : ?>
                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
            <?php endif; endif; ?>
        </div><!-- .site-branding -->
    </header>
</div>
<?php if ( !is_front_page() && !is_home() ) : get_template_part( 'templates/the-strip'); endif; ?>
<div class="container">
    <div id="content" class="site-content">