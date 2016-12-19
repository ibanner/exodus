<?php

// ADD TO ADMIN MENU
add_action( 'admin_menu', 'exodus_settings_add_menu' );

function exodus_settings_add_menu() {
    add_menu_page( __('Exodus Settings' , 'exodus') , __('Exodus Settings' , 'exodus') , 'manage_options', 'exodus-settings-page', 'exodus_settings_page', null, 99);
}

// REGISTER THE DAMN SETTINGS
add_action( 'admin_init', 'register_exodus_settings' );

function register_exodus_settings() {
    register_setting('exodus-settings', 'social-single');
    register_setting('exodus-settings', 'ga-code');
}

// CREATE THE FORM WRAPPER
function exodus_settings_page() { ?>
    <div class="wrap">
        <h1><?php _e('Exodus Settings' , 'exodus'); ?></h1>
        <form method="post" action="options.php">

            <?php
            settings_fields('exodus-settings');
            do_settings_sections('exodus-settings-page');
            submit_button();
            ?>
        </form>
    </div>
<?php }

// SINGULAR FORM FIELDS SETUP ZONE

// Social Sharing Shortcodes
function setting_label_social_single() { ?>
    <input type="text" name="social-single" id="social-single" value="<?php echo get_option('social-single'); ?>" />
<?php }

// Set Google Analytics Tracking Code
function setting_label_ga_code() { ?>
    <input type="text" name="ga-code" id="ga-code" value="<?php echo get_option('ga-code'); ?>" />
<?php }

// POPULATE THE FORM
add_action( 'admin_init', 'exodus_settings_page_setup' );

function exodus_settings_page_setup() {
    add_settings_section('social-sharing-buttons', __('Social Sharing Shortcodes', 'exodus') , null, 'exodus-settings-page');
    add_settings_field('social-single', __('In Single Pages' , 'exodus') , 'setting_label_social_single', 'exodus-settings-page', 'social-sharing-buttons');

    add_settings_section('google-analytics', __('Google Analytics', 'exodus') , null, 'exodus-settings-page');
    add_settings_field('text', __('Tracking Code' , 'exodus') , 'setting_label_ga_code', 'exodus-settings-page', 'google-analytics');
}

/************************************************/
//      ACF Options Page
//      @https://www.advancedcustomfields.com/resources/acf_add_options_page/
/************************************************/

$args = array(
    'page_title' => 'Homepage Slider',
    'menu_title' => '',
    'parent_slug' => 'exodus-settings-page',
);

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page($args);
}