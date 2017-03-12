<?php
/**************************************************/
//                FUNCTIONS TOC                   //
/**************************************************/

/* 0. Exodus Setup
/* 1. Add scripts and stylesheets
/* 2. Theme Support
/* 3. Admin Stuff

*/

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
}
endif;
add_action( 'after_setup_theme', 'exodus_setup' );

function exodus_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'exodus_content_width', 1170 );
}
add_action( 'after_setup_theme', 'exodus_content_width', 0 );

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
// 3. Admin Stuff
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

// Support menu-order for posts

function exodus_posts_menu_order()
{
    add_post_type_support( 'post', 'page-attributes' );
}

add_action( 'admin_init', 'exodus_posts_menu_order' );

/****************************************/

add_filter('acf/validate_value/type=oembed', 'exodus_acf_validate_oembed', 10, 4);

function exodus_acf_validate_oembed( $valid, $value, $field, $input ){

    // - Supported YouTube URL formats:
    //   - http://www.youtube.com/watch?v=My2FRPA3Gf8
    //   - http://youtu.be/My2FRPA3Gf8
    // - Supported Vimeo URL formats:
    //   - http://vimeo.com/25451551
    //   - http://player.vimeo.com/video/25451551
    // - Also supports relative URLs:
    //   - //player.vimeo.com/video/25451551
    // Source: http://stackoverflow.com/questions/5612602/improving-regex-for-parsing-youtube-vimeo-urls

    // bail early if value is already invalid
    if( empty($value) || !$valid ) {return $valid;}

    $pattern = '/(http:\/\/|https:\/\/|)(player.|www.)?(vimeo\.com|youtube\.com|youtu\.be)\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/';
    $match = preg_match($pattern, $value);

    if ( !empty($value) && $match != 1) {
        $valid = "This isn't a valid video URL (Currently supporting YouTube and Vimeo only).";
    }

    return $valid;
}

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

    // 1. Setup vars

        $args_unordered = '';
        $args_ordered = '';
        $ids_unordered = '';
        $ids_ordered = '';

    // 2. Get the unordered posts first (menu_order = 0) into $ids_unordered

        if ($loop == 'my-siddur') {

            $curuser = get_current_user_id();
            $siddur = 'siddur_' . $curuser . '_1';
            $args_unordered = array(
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

            $args_unordered = array(
                'posts_per_page' => -1,
                'menu_order' => 0,
            );

        } elseif ($loop == 'cat') {

            $args_unordered = array(
                'posts_per_page' => -1,
                'cat' => get_query_var('cat'),
                'menu_order' => 0,
            );
        }

        $query_unordered = new WP_Query($args_unordered);

        while ($query_unordered->have_posts()) {
            $query_unordered->the_post();
            $ids_unordered[] = get_the_ID();
        }

    // 3. Get the ordered posts into $ids_ordered by filtering the unordered

        if ($loop == 'index') {

            $args_ordered = array(
                'posts_per_page' => -1,
                'post__not_in' => $ids_unordered,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            );

        } elseif ($loop == 'cat') {

            $args_ordered = array(
                'posts_per_page' => -1,
                'cat' => get_query_var('cat'),
                'post__not_in' => $ids_unordered,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            );

        }

        if ($loop != 'my-siddur') {

            $query_ordered = new WP_Query($args_ordered);

            while ($query_ordered->have_posts()) {
                $query_ordered->the_post();
                $ids_ordered[] = get_the_ID();
            }

    // 4. Merge $ids_ordered and $ids_unordered

        $ids = is_array($ids_ordered) ? array_merge($ids_ordered,$ids_unordered) : $ids_unordered;

        } else {

            $ids = $ids_unordered;

        }

    // 5. Implode and return

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