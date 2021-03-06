<?php

/**
 * Created for kolehad.org
 * Author: Itay Banner
 * Author website: http://ibanner.co.il
 * Date: 07/11/2017
 * Time: 09:43
 * @package: 2.2.0
 */


/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */

function exodus_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */

    $plugins = array(

        // This is an example of how to include a plugin bundled with a theme.
        array(
            'name'      => 'Social',
            'slug'      => 'social-media-builder',
            'required'  => true,
        ),

        array(
            'name'      => 'Nav Menu Roles',
            'slug'      => 'nav-menu-roles',
            'required'  => false,
        ),

        array(
            'name'      => 'Post Views Counter',
            'slug'      => 'post-views-counter',
            'required'  => false,
        ),

        array(
            'name'      => 'LTR-RTL Admin',
            'slug'      => 'ltrrtl-admin-content',
            'required'  => false,
        ),

        array(
            'name'      => 'Categories Metabox Enhanced',
            'slug'      => 'categories-metabox-enhanced',
            'required'  => false,
        ),

        array(
            'name'      => 'Ajax Load More Theme Repeaters',
            'slug'      => 'ajax-load-more-theme-repeaters',
            'source'    => get_template_directory() . '/lib/plugins/ajax-load-more-theme-repeaters-v1.0.zip',
            'required'  => true,
        ),

        array(
            'name'      => 'SearchWP',
            'slug'      => 'searchwp',
            'source'    => get_template_directory() . '/lib/plugins/searchwp-2.8.17.zip',
            'required'  => true,
        ),

        array(
            'name'      => 'SearchWP for WPML',
            'slug'      => 'searchwp-wpml',
            'source'    => get_template_directory() . '/lib/plugins/searchwp-wpml-1.4.0.zip',
            'required'  => true,
        ),

        array(
            'name'      => 'Printer Friendly',
            'slug'      => 'printfriendly',
            'required'  => false,
        ),
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'exodus',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

        /*
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'exodus' ),
            'menu_title'                      => __( 'Install Plugins', 'exodus' ),
            /* translators: %s: plugin name. * /
            'installing'                      => __( 'Installing Plugin: %s', 'exodus' ),
            /* translators: %s: plugin name. * /
            'updating'                        => __( 'Updating Plugin: %s', 'exodus' ),
            'oops'                            => __( 'Something went wrong with the plugin API.', 'exodus' ),
            'notice_can_install_required'     => _n_noop(
                /* translators: 1: plugin name(s). * /
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'exodus'
            ),
            'notice_can_install_recommended'  => _n_noop(
                /* translators: 1: plugin name(s). * /
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'exodus'
            ),
            'notice_ask_to_update'            => _n_noop(
                /* translators: 1: plugin name(s). * /
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'exodus'
            ),
            'notice_ask_to_update_maybe'      => _n_noop(
                /* translators: 1: plugin name(s). * /
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'exodus'
            ),
            'notice_can_activate_required'    => _n_noop(
                /* translators: 1: plugin name(s). * /
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'exodus'
            ),
            'notice_can_activate_recommended' => _n_noop(
                /* translators: 1: plugin name(s). * /
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'exodus'
            ),
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'exodus'
            ),
            'update_link' 					  => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                'exodus'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'exodus'
            ),
            'return'                          => __( 'Return to Required Plugins Installer', 'exodus' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'exodus' ),
            'activated_successfully'          => __( 'The following plugin was activated successfully:', 'exodus' ),
            /* translators: 1: plugin name. * /
            'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'exodus' ),
            /* translators: 1: plugin name. * /
            'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'exodus' ),
            /* translators: 1: dashboard link. * /
            'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'exodus' ),
            'dismiss'                         => __( 'Dismiss this notice', 'exodus' ),
            'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'exodus' ),
            'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'exodus' ),

            'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
        ),
        */
    );

    tgmpa( $plugins, $config );
}