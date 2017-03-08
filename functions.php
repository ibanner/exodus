<?php
/**************************************************/
//                FUNCTIONS TOC                   //
/**************************************************/

/* 0. Exodus Setup
/* 1. Add scripts and stylesheets
/* 2. Theme Support
/* 3. Custom Settings Pages
/* 4. Widget Areas

*/

if ( ! function_exists( 'exodus_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function exodus_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Kol Ehad, use a find and replace
     * to change 'exodus' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'exodus', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1170, 658, true );

    // This theme uses wp_nav_menu() in 2 locations.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'exodus' ),
        'secondary' => esc_html__( 'Secondary Menu', 'exodus' ),
        'account' => esc_html__( 'Account Menu', 'exodus' ),
    ) );

    add_theme_support( 'post-formats', array( 'gallery' , 'image' , 'video' , 'audio' , 'link' , 'quote' ) );
    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'exodus_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );
}
endif;
add_action( 'after_setup_theme', 'exodus_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function exodus_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'exodus_content_width', 1170 );
}
add_action( 'after_setup_theme', 'exodus_content_width', 0 );

// Show CPTs on archive pages
/*function exodus_add_custom_types( $query ) {
    if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
        $query->set( 'post_type', array(
            'post', 'nav_menu_item' , 'ritual', 'text'
        ));
        return $query;
    } elseif ( is_home() && $query->is_main_query() ) {
        $query->set( 'post_type', array( 'post', 'ritual', 'text' ) );
        return $query;
    }

}
add_filter( 'pre_get_posts', 'exodus_add_custom_types' );*/

// Google Analytics Code
add_action('wp_footer', 'add_ga_code');
function add_ga_code() {
    $code = get_option('ga-code');
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

// When a new user is registered, create their initial Siddur term
add_action( 'user_register' , 'exodus_create_siddur' , 10 , 1 );
function exodus_create_siddur($user_id) {
    $siddur = 'siddur_' . $user_id . '_1';
    if ( !term_exists( $siddur ) ) {
        wp_insert_term( $siddur , 'siddurim' , array('slug' => $siddur));
    }
}

/* -------------------------------------------------
// 1. Add scripts and stylesheets
------------------------------------------------- */
function exodus_scripts() {
    // Bootstrap
    wp_dequeue_style( 'searchwp-live-search' );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' , array(), '3.3.7' );
    wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' , array(), '4.7.0' );
    wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array('jquery'), '3.3.5', true );

    // Local
    wp_enqueue_style( 'exodus', get_template_directory_uri() . '/style.css' );
    wp_enqueue_script( 'exodus-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20151215', true );
    wp_localize_script( 'exodus-navigation', 'screenReaderText', array(
        'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'exodus' ) . '</span>',
        'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'exodus' ) . '</span>',
    ) );
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
    wp_enqueue_script( 'exodus-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );



    if (is_home() || is_front_page()) {
        wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css' , array(), '2.6.2' );
        wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array( 'jquery' ), '20151215', true );
    }

    if (is_home() || is_front_page() || is_category() || is_archive() || is_search() || is_page('my-siddur')) {
        wp_enqueue_style( 'ajax-load-more', get_template_directory_uri() . '/css/alm.css' );
        wp_enqueue_script( 'masonry');
        wp_enqueue_script( 'imagesloaded');
        wp_enqueue_script( 'masonry-alm', get_template_directory_uri() . '/js/masonry-alm.js', array( 'jquery' ), '', true );
    }

    wp_enqueue_script( 'exodus-plugin-hacks', get_template_directory_uri() . '/js/plugin-hacks.js', array( 'jquery' ), '0.1', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Add Google Fonts
    wp_enqueue_style( 'exodus-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,700|Open+Sans:400,700&subset=hebrew' );
}

add_action( 'wp_enqueue_scripts', 'exodus_scripts' );

/* -------------------------------------------------
// 2. Theme Support & Requires
------------------------------------------------- */

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/options.php';
require get_template_directory() . '/inc/siddur.php';
require get_template_directory() . '/inc/cpt-config.php';           // Register Custom Post Types locally
require get_template_directory() . '/inc/extras.php';               // Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jetpack.php';

// TGM - Required Plugins
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'exodus_register_required_plugins' );
require get_template_directory() . '/inc/required-plugins.php';

// Template Tags sandbox - DEV only
// include get_template_directory() . '/inc/temp-template-tags.php';

/* -------------------------------------------------
// 3. Widget Areas
------------------------------------------------- */

/* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar */

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

/****************************************/

function my_kses_post( $value ) {

    // is array
    if( is_array($value) ) {
        return array_map('my_kses_post', $value);
    }

    // return
    return wp_kses_post( $value );
}
add_filter('acf/update_value', 'my_kses_post', 10, 1);

/*******************************************/

if ( ! function_exists( 'exodus_siddur_action_handler' ) ) :
    /**
     * This function will handle clearing Siddur add/remove requests
     */
    function exodus_siddur_action_handler() {

        $alert = '';

        if (
            isset($_GET['sidaction']) &&
            isset($_GET['post_id']) &&
            isset($_GET['nonce'])
        ) {
            $siddur = 'siddur_' . get_current_user_id() . '_1';

            if (
                $_GET['sidaction'] === 'add' &&
                wp_verify_nonce($_GET['nonce'], 'exodus-siddur-add')
            ) {
                wp_set_object_terms( $_GET['post_id'] , $siddur , 'siddurim' , true );
            } elseif (
                $_GET['sidaction'] === 'remove' &&
                wp_verify_nonce($_GET['nonce'], 'exodus-siddur-remove')
            ) {
                wp_remove_object_terms( $_GET['post_id'] , $siddur , 'siddurim' );
            }

            // So how did it go?
            if ($_GET['sidaction'] === 'add' && has_term($siddur, 'siddurim' , $_GET['post_id'] )) {
                $alert = 'success_add';
            } elseif ($_GET['sidaction'] === 'remove' && !has_term($siddur, 'siddurim' , $_GET['post_id'])) {
                $alert = 'success_remove';
            } elseif ($_GET['sidaction'] === 'add' && !has_term($siddur, 'siddurim' , $_GET['post_id'])) {
                $alert = 'fail_add';
            } elseif ($_GET['sidaction'] === 'remove' && has_term($siddur, 'siddurim' , $_GET['post_id'])) {
                $alert = 'fail_remove';
            }
        }
        return $alert;
    }

endif;

/*******************************************/
/* Hack WP Login Styles */
function exodus_login_styles() { ?>
    <style type="text/css"> #login h1 a, .login h1 a { background-image: none; width: 100%; padding-bottom: 30px; font-size: 3rem; text-indent: 0; } body.login { background: #c8ddf0; } .login label { color: #fff  !important; } .login form { background: #03A9F4 !important; } </style>
<?php }
add_action( 'login_enqueue_scripts', 'exodus_login_styles' );

/*******************************************/
/*             ALM Functions               */
/*******************************************/

add_filter( 'alm_debug', '__return_true' );

/*******************************************/

if (! function_exists( 'exodus_alm_query_ids' )) {

    function exodus_alm_query_ids($loop) {

        $ids = '';
        $args = '';

    if ($loop == 'my-siddur') {

        $curuser = get_current_user_id();
        $siddur = 'siddur_' . $curuser . '_1';
        $args = array(
            'post_type' => 'post',
            'tax_query' => array(
                array(
                    'taxonomy' => 'siddurim',
                    'field' => 'slug',
                    'terms' => $siddur,
                ),
            ),
        );

    } elseif ($loop == 'index') {

        $ids = get_option('sticky_posts');
        rsort($ids);

        $args = array(
            'post__not_in' => $ids,
            'posts_per_page' => -1,
        );

    } elseif ($loop == 'cat') {

        $stickies = get_option('sticky_posts');
        $ids = array();

        if (!is_array($stickies)) {
            $ids[0] = $stickies;
        } else {
            foreach ($stickies as $sticky) {
                if (has_category(get_query_var('cat'),$sticky)) {
                    $ids[] = $sticky;
                }
            }
        }

        $args = array(
            'posts_per_page' => -1,
            'post__not_in' => $ids,
            'cat' => get_query_var('cat'),
        );
    }
        $the_query = new WP_Query($args);

        while ($the_query->have_posts()) {
            $the_query->the_post();
            $ids[] = get_the_ID();
        }

        $ids = implode(', ', $ids);
        wp_reset_postdata();

        return $ids;
    }
}
/*******************************************/

if (! function_exists('exodus_alm_shortcode')) {
    function exodus_alm_shortcode($ids,$type) {
        // Get params from URL
        $search = (isset($_GET['s'])) ? $_GET['s'] : '';
        $shortcode = '[ajax_load_more post_type="post" posts_per_page="12" images_loaded="true"'; // basic shortcode start
        //preloaded="true" preloaded_amount="12"

        // Start Building the shortcode

        if (is_search()) {

            $shortcode .= ' search="'. $search .'"';

        } elseif (is_author()) {

            $author = get_query_var('author');
            $shortcode .= ' author="'. $author .'"';

        } /*elseif (is_category()) {

            $cat = get_query_var('cat');
            $category = get_category ($cat);
            $shortcode .= ' category="'. $category->slug .'"';

        }*/ elseif (isset($ids)) {
            $shortcode .= ' post__in="'.$ids.'" orderby="post__in"';
        }

        if (!empty($type)) {
            $shortcode .= ' taxonomy="post_types_tax" taxonomy_terms="'. $type .'" taxonomy_operator="IN"';
        }

        $button_label = __('Older Items' , 'exodus');
        $shortcode .= ' button_label="'. $button_label .'"]';

        echo do_shortcode($shortcode);
    }
}

/*******************************************/
/*            POST VALIDATION              */
/*******************************************/

add_action('save_post', 'exodus_validate_thumbnail_size');

function exodus_validate_thumbnail_size($post_id) {

    // Only validate post type of post
    if( get_post_type( $post_id ) != 'post' )
        return;

    // Only validate if featured image is set
    if ( !has_post_thumbnail( $post_id ) )
        return;

    // Check post has a thumbnail
    $thumb = get_post_thumbnail_id( $post_id );
    $tsize = wp_get_attachment_image_src( $thumb , 'full' );


    if ( $tsize[1] < 1170 ) {
        // Confirm validate thumbnail has failed
        set_transient( "exodus_validate_thumbnail_size_failed", "true" );

        // Remove this action so we can resave the post as a draft and then reattach the post
        remove_action('save_post', 'exodus_validate_thumbnail_size');
        delete_post_thumbnail( $post_id );
        add_action('save_post', 'exodus_validate_thumbnail_size');
    } else {
        // If the post has a thumbnail delete the transient
        delete_transient( "exodus_validate_thumbnail_size_failed" );
    }
}

add_action('admin_notices', 'exodus_validate_thumbnail_size_error');
function exodus_validate_thumbnail_size_error()
{
    // check if the transient is set, and display the error message
    if ( get_transient( "exodus_validate_thumbnail_size_failed" ) == "true" ) {
        echo "<div id='message' class='error'><p><strong>" . __('The Featured image you set was too small and was removed. Please set another image, at least 1170px wide!' , 'exodus' ) . "</strong></p></div>";
        delete_transient( "exodus_validate_thumbnail_size_failed" );
    }
}