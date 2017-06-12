<?php
/**
 * Created for kolehad.org
 * Author: Itay Banner
 * Author website: http://ibanner.co.il
 * Date: 07/06/2017
 * Time: 15:48
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/* -------------------------------------------------
// Add scripts and stylesheets
------------------------------------------------- */
function exodus_scripts() {
    // Bootstrap
    wp_dequeue_style( 'searchwp-live-search' );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' , array(), '3.3.7' );
    wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' , array(), '4.7.0' );
    wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array('jquery'), '3.3.5', true );

    // Local
    wp_enqueue_style( 'exodus', get_template_directory_uri() . '/css/main.css' );
    wp_enqueue_script( 'exodus-navigation', get_template_directory_uri() . '/js/min/navigation.min.js', array( 'jquery' ), '20151215', true );
    wp_localize_script( 'exodus-navigation', 'screenReaderText', array(
        'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'exodus' ) . '</span>',
        'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'exodus' ) . '</span>',
    ) );
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/min/navigation.min.js', array(), '20151215', true );
    wp_enqueue_script( 'exodus-skip-link-focus-fix', get_template_directory_uri() . '/js/min/skip-link-focus-fix.min.js', array(), '20151215', true );
    // wp_enqueue_script( 'live-js', get_template_directory_uri() . '/js/min/live.min.js', array(), '20151215', true );



    /*if (is_home() || is_front_page()) {
        wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css' , array(), '2.6.2' );
        wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/min/jquery.flexslider.min.js', array( 'jquery' ), '20151215', true );
    }*/

    if (is_home() || is_front_page() || is_category() || is_archive() || is_search() || is_page('my-siddur')) {
        wp_enqueue_script( 'masonry');
        wp_enqueue_script( 'imagesloaded');
        wp_enqueue_script( 'masonry-alm', get_template_directory_uri() . '/js/min/masonry-alm.min.js', array( 'jquery' ), '', true );
    }

    wp_enqueue_script( 'exodus-plugin-hacks', get_template_directory_uri() . '/js/min/plugin-hacks.min.js', array( 'jquery' ), '0.1', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Add Google Fonts
    wp_enqueue_style( 'exodus-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,700|Roboto:400,700|Open+Sans:400,700' );
    if ( is_rtl() || !is_admin() ) {
        wp_enqueue_style( 'exodus-open-sans-hebrew', 'https://fonts.googleapis.com/earlyaccess/opensanshebrew.css' );
    }
}

add_action( 'wp_enqueue_scripts', 'exodus_scripts' );