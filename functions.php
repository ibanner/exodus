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
    set_post_thumbnail_size( 828, 360, true );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'exodus' ),
        /*'secondary' => esc_html__( 'Secondary Menu', 'exodus' ),*/
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
function exodus_add_custom_types( $query ) {
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
add_filter( 'pre_get_posts', 'exodus_add_custom_types' );


/* -------------------------------------------------
// 1. Add scripts and stylesheets
------------------------------------------------- */
function exodus_scripts() {
    // Bootstrap
    // wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' , array(), '3.3.5' );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' , array(), '3.3.7' );
    wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' , array(), '4.7.0' );
    // wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '', true );
    // wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array('jquery'), '3.3.6', true );
    // wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/jquery-3.1.1.min.js', array(), '3.1.1', true );

    // Local
    wp_enqueue_style( 'exodus', get_template_directory_uri() . '/style.css' );
    //wp_enqueue_style( 'bootstrap-blog', get_template_directory_uri() . '/css/blog.css' );
    wp_enqueue_script( 'exodus-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20151215', true );
    wp_localize_script( 'exodus-navigation', 'screenReaderText', array(
        'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'exodus' ) . '</span>',
        'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'exodus' ) . '</span>',
    ) );
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
    wp_enqueue_script( 'exodus-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
    wp_enqueue_script( 'masonry');
    wp_enqueue_script( 'masonry-grid', get_template_directory_uri() . '/js/masonry-grid.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'isotope', 'https://unpkg.com/isotope-layout@3.0/dist/isotope.pkgd.min.js' , array(), '3.0' , true );
    wp_enqueue_script( 'isotope-filter', get_template_directory_uri() . '/js/isotope.js', array( 'jquery' ), '3.0', true );
    // wp_enqueue_script( 'fitColumns', get_template_directory_uri() . '/js/fit-columns.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'exodus-social-bypass', get_template_directory_uri() . '/js/social-bypass.js', array( 'jquery' ), '0.1', true );
    wp_localize_script( 'exodus-social-bypass', 'spanLabel', array(
        'Share This'   => __( 'Share This', 'exodus' )
    ) );


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Add Google Fonts
    wp_enqueue_style( 'exodus-google-fonts', 'https://fonts.googleapis.com/css?family=Assistant:400,700|Tinos:400,700&subset=hebrew' );
}

add_action( 'wp_enqueue_scripts', 'exodus_scripts' );

/* -------------------------------------------------
// 2. Theme Support & Requires
------------------------------------------------- */

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/cpt-config.php';           // Register Custom Post Types locally
require get_template_directory() . '/inc/extras.php';               // Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jetpack.php';

// TGM - Required Plugins
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'exodus_register_required_plugins' );
require get_template_directory() . '/inc/required-plugins.php';

// Template Tags sandbox - DEV only
include get_template_directory() . '/inc/temp-template-tags.php';

/* -------------------------------------------------
// 3. Custom Settings Pages
------------------------------------------------- */
function custom_settings_add_menu() {
    add_menu_page( 'Custom Settings', 'Custom Settings', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99);
}
add_action( 'admin_menu', 'custom_settings_add_menu' );

// Create Custom Global Settings
function custom_settings_page() { ?>
    <div class="wrap">
        <h1>Custom Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('article-type-labels');
            settings_fields('social-sharing-buttons');
            do_settings_sections('theme-options');
            submit_button();
            ?>
        </form>
    </div>
<?php }

// Post Type Labels Override
function setting_label_ritual() { ?>
    <input type="text" name="ritual" id="ritual" value="<?php echo get_option('ritual'); ?>" />
<?php }

function setting_label_event() { ?>
    <input type="text" name="event" id="event" value="<?php echo get_option('event'); ?>" />
<?php }

function setting_label_text() { ?>
    <input type="text" name="text" id="text" value="<?php echo get_option('text'); ?>" />
<?php }

// Social Sharing Shortcodes
function setting_label_social_loop() { ?>
    <input type="text" name="social-loop" id="social-loop" value="<?php echo get_option('social-loop'); ?>" />
    <p><?php _e( "<b>Important:</b> Please Make sure to enable 'Toggle dropdown to show buttons' for this shortcode" , 'exodus') ?></p>
<?php }

function setting_label_social_single() { ?>
    <input type="text" name="social-single" id="social-single" value="<?php echo get_option('social-single'); ?>" />
<?php }

function custom_settings_page_setup() {
    add_settings_section('article-type-labels', __('Article Type Labels', 'exodus') , null, 'theme-options');
    add_settings_field('ritual', __('Ritual' , 'exodus') , 'setting_label_ritual', 'theme-options', 'article-type-labels');
    add_settings_field('event', __('Event' , 'exodus') , 'setting_label_event', 'theme-options', 'article-type-labels');
    add_settings_field('text', __('Text' , 'exodus') , 'setting_label_text', 'theme-options', 'article-type-labels');

    add_settings_section('social-sharing-buttons', __('Social Sharing Shortcodes', 'exodus') , null, 'theme-options');
    add_settings_field('social-loop', __('In Lists' , 'exodus') , 'setting_label_social_loop', 'theme-options', 'social-sharing-buttons');
    add_settings_field('social-single', __('In Single Pages' , 'exodus') , 'setting_label_social_single', 'theme-options', 'social-sharing-buttons');


    register_setting('article-type-labels', 'ritual');
    register_setting('article-type-labels', 'event');
    register_setting('article-type-labels', 'text');
    register_setting('social-sharing-buttons', 'social-loop');
    register_setting('social-sharing-buttons', 'social-single');

}
add_action( 'admin_init', 'custom_settings_page_setup' );

/* -------------------------------------------------
// 4. Widget Areas
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