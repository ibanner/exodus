<?php
/**
 * Created for kolehad.org
 * Author: Itay Banner
 * Author website: http://ibanner.co.il
 * Date: 08/06/2017
 * Time: 08:08
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

//vars
$home_url = apply_filters( 'wpml_home_url', get_option( 'home' ) );
$site_title = get_bloginfo( 'name' );
$type = (isset($_GET['type'])) ? $_GET['type'] : '';

?>

<header role="banner" class="page-head">

    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'exodus' ); ?></a>

    <section class="page-head__top">

        <div class="wrapper--head-top">
            <div class="page-head__menu-toggle">
                <button class="btn__menu-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <i id="bar-icon" class="fa fa-bars icon-border" aria-hidden="true"></i>
                    <span class="sr-only"><?php esc_html_e('Menu', 'exodus'); ?></span>
                </button>
            </div>

            <div class="page-head__masthead">
                <a href="<?php echo $home_url; ?>" class="btn--logo logo-link">
                    <?php echo $site_title; ?>
                </a>
                <div class="screen-reader-text">
                    <?php printf(esc_html__('Go to the home page of %1$s', 'exodus'), $site_title); ?>
                </div>
            </div>

            <!--<div class="lang-switch">-->
                <?php exodus_wpml_switch(); ?>
<!--            </div>-->
        </div>

    </section>


    <section class="page-head__search" role="search">
        <form id="header-search" class="search-form search-form--header" action="<?php echo $home_url; ?>" method="get" _lpchecked="1">
            <input type="text" class="input input--search" name="s" placeholder="<?php _e( 'Pick a Jewish brain' , 'exodus' ); ?>">
            <button type="submit" class="btn btn-link input__search-icon"><i id="search-icon" class="fa fa-search" aria-hidden="true"></i></button>
            <?php exodus_post_types_tax_droplist_ui($type); ?>
        </form>
    </section>

    <nav id="site-navigation" class="page-head__navbar main-navigation" role="navigation">
        <?php
        wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu primary' ) );
        ?>
        <div class="main-navigation__more">
            <button type="button" class="btn btn-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
        </div>
    </nav><!-- #site-navigation -->

</header>
