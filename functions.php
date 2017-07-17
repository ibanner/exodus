<?php
/**
 * Created for kolehad.org
 * Author: Itay Banner
 * Author website: http://ibanner.co.il
 * Date: 05/06/2017
 * Time: 12:33
 */

require_once("functions/exodus-config.php");             // Theme Configuration and Constants
require_once("functions/exodus-setup.php");              // Theme supports
require_once("functions/exodus-enqueue.php");            // Scripts & Stylesheets
require_once("functions/media.php");                     // Media-related functions

// Admin Functions
require_once("admin/exodus-login.php");                   // Login page branding
require_once("admin/post-columns.php");                   // Post list table modification
require_once("admin/required-plugins.php");

// Plugin-related
require_once("functions/vendor/class-tgm-plugin-activation.php");
add_action( 'tgmpa_register', 'exodus_register_required_plugins' );

require_once("functions/vendor/alm.php");                       // Ajax-Load-More
require_once("functions/vendor/acf.php");                       // Advanced Custom Fields - Helper Functions
require_once("functions/vendor/acf-fields.php");                // Advanced Custom Fields - Field Groups
require_once("functions/vendor/wpml.php");                      // AKA sitepress-multilingual-cms
require_once("functions/vendor/sgmb.php");                      // Social Media Builder

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/options.php';
require get_template_directory() . '/inc/siddur.php';
require get_template_directory() . '/inc/cpt-config.php';           // Register Custom Post Types locally
require get_template_directory() . '/inc/extras.php';               // Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jetpack.php';