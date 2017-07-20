<?php
/**
 * THEME CONFIGURATION
 * Built for kolehad.org
 *
 * @author		Itay Banner (http://ibanner.co.il)
 * @package		bh/functions
 * @version		2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * theme prefix => exodus
 */

/**
 * Theme version
 * Used to register styles and scripts
 */
if ( function_exists('wp_get_theme') ) {

    $theme_data = wp_get_theme();
    $theme_version = $theme_data->get('Version');

} else {

    $theme_data = get_theme_data( trailingslashit(get_stylesheet_directory()).'style.css' );
    $theme_version = $theme_data['Version'];

}
define( 'VERSION', $theme_version );

/**
 * Other constants
 */
$stylesheet = get_stylesheet();
$theme_root = get_theme_root( $stylesheet );

define( 'TEMPLATE',		get_bloginfo('template_directory') );
define( 'HOME',			home_url( '/' ) );
define( 'THEME_ROOT',	"$theme_root/$stylesheet" );
define( 'CSS_DIR',		TEMPLATE . '/css' );
define( 'JS_DIR',		TEMPLATE . '/js' );
define( 'IMAGES_DIR',	TEMPLATE . '/images' );

/**
 * Google Fonts
 */
$google_fonts = array (
    'Open Sans'			=> 'http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,700',
	'Open Sans Hebrew'	=> 'http://fonts.googleapis.com/earlyaccess/opensanshebrew.css'
);