<?php
/**
 * Created for kolehad.org
 * Author: Itay Banner
 * Author website: http://ibanner.co.il
 * Date: 08/06/2017
 * Time: 10:14
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/******************************************************/

if ( ! function_exists( 'exodus_social_links' ) ) :

    /**
     * Prints the social links
     */

    function exodus_social_links($location) {
        $social_option = get_option($location);

        if ( strpos( $social_option , 'sgmb') === 1 ) {
            $social = do_shortcode( $social_option );
        } else {
            $social = __('Not Set' , "exodus"); //TODO Probably some extra guidance is required
        }
        echo $social;
    }


endif;