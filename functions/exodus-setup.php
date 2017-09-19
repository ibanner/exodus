<?php
/**
 * Created for kolehad.org
 * Author: Itay Banner
 * Author website: http://ibanner.co.il
 * Date: 07/06/2017
 * Time: 15:39
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*-------------------------------------------------------------------------------
	BASIC SETUP
-------------------------------------------------------------------------------*/

// 1. TEXTDOMAIN & THEME SUPPORTS

if ( ! function_exists( 'exodus_setup' ) ) :

    function exodus_setup() {

        load_theme_textdomain( 'exodus', get_template_directory() . '/languages' );

        add_theme_support( 'automatic-feed-links' );    // Add default posts and comments RSS feed links to head.
        add_theme_support( 'title-tag' );               //Let WordPress manage the document title.
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1170, 658, true );

        // This theme uses wp_nav_menu() in 2 locations.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'exodus' ),
            'secondary' => esc_html__( 'Secondary Menu', 'exodus' ),
            'account' => esc_html__( 'Account Menu', 'exodus' ),
        ) );

        add_theme_support( 'post-formats', array( 'gallery' , 'image' , 'video' , 'audio' , 'link' , 'quote' ) );
        add_theme_support( 'html5', array('search-form','comment-form','comment-list','gallery','caption' ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'exodus_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Set up the default content width
        $GLOBALS['content_width'] = apply_filters( 'exodus_content_width', 1170 );
    }
endif;

add_action( 'after_setup_theme', 'exodus_setup' );

// 2. REGISTER SIDEBARS

function exodus_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Articles Sidebar', 'exodus' ),
        'id'            => 'articles',
        'description'   => esc_html__( 'These widgets will appear in article pages.', 'exodus' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s sidebar-module sidebar-module-inset">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'exodus_widgets_init' );

// 3. SUPPORT menu-order FOR POSTS

function exodus_posts_menu_order() {
    add_post_type_support( 'post', 'page-attributes' );
}
add_action( 'admin_init', 'exodus_posts_menu_order' );

// 4. REGISTER DEFAULT HEADER

register_default_headers( array(
    'kem-logo' => array(
        'url'   => get_stylesheet_directory_uri() . '/images/vectors/logo.svg',
        'thumbnail_url' => get_stylesheet_directory_uri() . '/images/vectors/logo.svg',
        'description'   => __( 'KEM Logo', 'exodus' )
    )
));

// 5. PUT COMMENT FIELD BACK WHERE IT BELONGS
function exodus_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter( 'comment_form_fields', 'exodus_move_comment_field_to_bottom' );

/*-------------------------------------------------------------------------------
	PARALLAX LAYOUT
-------------------------------------------------------------------------------*/

/**
 *  Checks if the current page should display the parallax header
 *
 * @return boolean
 */
function exodus_is_parallax_page() {
    $is_parallax = false;
    if ( is_home() || is_front_page() ) {
        $is_parallax = true;
    }
    return $is_parallax;
}

/*-------------------------------------------------------------------------------
	GOOGLE ANALYTICS CODE
-------------------------------------------------------------------------------*/

add_action('wp_footer', 'add_ga_code');
function add_ga_code() {
    $code = get_field('ga_code', 'option');
    if (!empty($code)) {
        echo '<!-- Google Analytics -->';
        echo '<script>';
        echo "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga'); ga('create', '" . $code . "', 'auto');ga('send', 'pageview');";
        echo '</script>';
        echo '<!-- End Google Analytics -->';
    } else {
        echo '<!-- Google Analytics Tracking Code Not Set -->';
    }
}

/*-------------------------------------------------------------------------------
	HONEYPOT
-------------------------------------------------------------------------------*/

function exodus_add_honeypot() {
    echo '<input type="hidden" name="tamutu" value="" />';
}

function exodus_verify_honeypot() {
    if ( ! isset( $_POST['tamutu'] ) ) {
        wp_die( 'Spammers are losers' );
    }
    if ( ! empty( $_POST['tamutu'] ) ) {
        wp_die( 'Spammers are losers' );
    }
}

add_action( 'register_form', 'exodus_add_honeypot' );
add_filter( 'registration_errors', 'exodus_verify_honeypot', 10, 3 );

add_action( 'comment_form_top', 'exodus_add_honeypot' );
add_filter( 'preprocess_comment', 'exodus_verify_honeypot' );