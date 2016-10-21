<?php
/**************************************************/
//                FUNCTIONS TOC                   //
/**************************************************/

/* 1. Add scripts and stylesheets
/* 2. Theme Support
/* 3. Custom Settings Pages
/* 4. Widget Areas

/* -------------------------------------------------
// 1. Add scripts and stylesheets
------------------------------------------------- */
function exodus_scripts() {
    // Bootstrap
    wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' , array(), '3.3.6' );
    wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '1.11.3', true );
    wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array('jquery'), '3.3.6', true );

    // Local
    wp_enqueue_style( 'bootstrap-blog', get_template_directory_uri() . '/css/blog.css' );

    // Add Google Fonts
    wp_enqueue_style( 'exodus-google-fonts', 'https://fonts.googleapis.com/css?family=Assistant:400,700|Tinos:400,700&subset=hebrew' );
}

add_action( 'wp_enqueue_scripts', 'exodus_scripts' );

/* -------------------------------------------------
// 2. Theme Support
------------------------------------------------- */
// Let WordPress handle titles
add_theme_support( 'title-tag' );

// Support Featured Images
add_theme_support( 'post-thumbnails' );

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
            settings_fields('section');
            do_settings_sections('theme-options');
            submit_button();
            ?>
        </form>
    </div>
<?php }

// Twitter
function setting_twitter() { ?>
    <input type="text" name="twitter" id="twitter" value="<?php echo get_option('twitter'); ?>" />
<?php }

function setting_youtube() { ?>
    <input type="text" name="youtube" id="youtube" value="<?php echo get_option('youtube'); ?>" />
<?php }

function setting_facebook() { ?>
    <input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>" />
<?php }

function custom_settings_page_setup() {
    add_settings_section('section', 'Social Network profiles', null, 'theme-options');
    add_settings_field('twitter', __('Twitter Username' , 'exodus') , 'setting_twitter', 'theme-options', 'section');
    add_settings_field('youtube', __('YouTube URL' , 'exodus') , 'setting_youtube', 'theme-options', 'section');
    add_settings_field('facebook', __('Facebook URL' , 'exodus') , 'setting_facebook', 'theme-options', 'section');

    register_setting('section', 'twitter');
    register_setting('section', 'youtube');
    register_setting('section', 'facebook');
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