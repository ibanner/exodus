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
$login_url = wp_login_url();
$signup_url = $login_url . '?action=register';
$site_title = get_bloginfo( 'name' );
$type = (isset($_GET['type'])) ? $_GET['type'] : '';
$p_container = ( exodus_is_parallax_page() ) ? 'parallax-container' : '';

?>

<header id="header" role="banner" class="page-head <?php echo $p_container; ?>">

    <?php if ( exodus_is_parallax_page() ) : ?>
    <div class="parallax">
        <img src="/wp-content/themes/exodus/images/home_bg_791.jpg">
    </div>
    <?php endif; ?>

    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'exodus' ); ?></a>

    <section class="page-head__top">

        <div class="wrapper--head-top">

            <div class="page-head__menu-toggle">
                <button class="btn__menu-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <i class="svg-bg svg-menu_toggle svg-menu_toggle-open"></i>
                    <span class="sr-only"><?php esc_html_e( 'Menu', 'exodus' ); ?></span>
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

            <?php exodus_wpml_switch(); ?>

            <?php if ( is_single() ) : ?>

                <div class="page-head__mini-search">
                    <form id="header-search" class="search-form search-form--mini-header" action="<?php echo $home_url; ?>" method="get" _lpchecked="1">
                        <input type="text" class="input input--search" name="s" placeholder="<?php esc_attr_e( 'Pick a Jewish brain' , 'exodus' ); ?>">
                        <button type="submit" class="btn btn-link input__search-icon"><?php echo exodus_get_icon('search', 'large', 'img' , esc_attr('Search Icon', 'exodus')); ?></button>
                        <?php exodus_post_types_tax_droplist_ui($type); ?>
                    </form>
                </div>

            <?php endif; ?>

            <div class="page-head__my-account hidden-xs">

                <?php if ( ! is_user_logged_in() ) : ?>

                    <p class="anon">
                        <a href="<?php echo esc_url($login_url); ?>" role="link"><?php _e('Log In', 'exodus'); ?></a> /
                        <a href="<?php echo esc_url($signup_url); ?>" role="link"><?php _e('Sign Up', 'exodus'); ?></a>
                        <?php exodus_default_user_avatar(); ?>
                    </p>

                <?php else: ?>

                    <p class="logged-in">

                        <?php
                        exodus_my_account_link();
                        exodus_current_user_avatar();
                        ?>

                    </p>

                <?php endif; ?>

            </div>

        </div>

    </section>


    <section class="page-head__search" role="search">
        <form id="header-search" class="search-form search-form--header" action="<?php echo $home_url; ?>" method="get" _lpchecked="1">
            <input type="text" class="input input--search" name="s" placeholder="<?php esc_attr_e( 'Pick a Jewish brain' , 'exodus' ); ?>">
            <button type="submit" class="btn btn-link input__search-icon"><?php echo exodus_get_icon('search', 'large', 'img' , esc_attr('Search Icon', 'exodus')); ?></button>
            <?php exodus_post_types_tax_droplist_ui($type); ?>
        </form>
    </section>

    <?php if ( ! is_single() ) : ?>

    <nav id="site-navigation" class="page-head__navbar main-navigation" role="navigation">
        <?php
        wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu primary' ) );
        ?>
        <div class="main-navigation__more">
            <button type="button" class="btn btn-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
        </div>
    </nav><!-- #site-navigation -->

    <?php endif; ?>

    <nav id="account-navigation" class="page-head__account-nav secondary-navigation" role="navigation">
        <?php
        wp_nav_menu( array( 'theme_location' => 'account', 'menu_class' => 'nav-menu account' ) );
        ?>
    </nav><!-- #account-navigation -->

</header>
