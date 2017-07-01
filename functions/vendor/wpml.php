<?php
/**
 * Created for kolehad.org
 * Author: Itay Banner
 * Author website: http://ibanner.co.il
 * Date: 08/06/2017
 * Time: 09:50
 */



if (!defined('ABSPATH')) exit; // Exit if accessed directly

/******************************************************/

if ( ! function_exists( 'exodus_wpml_switch' )) :
    function exodus_wpml_switch() {
        $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );


        if ( !empty( $languages ) ) {
            echo '<div class="wpml-switch">';
            foreach( $languages as $l ) {
                $flag_icon = file_get_contents( site_url() . '/wp-content/themes/exodus/images/vectors/lang-' . $l['code'] . '.svg');

                if ( $l['active'] ) {

                    echo $flag_icon;

                } else {

                    echo '<a href="' . $l['url'] . '" class="wpml-switch__link a--block">';
                    echo $flag_icon;
                    echo '</a>';

                }
            }

            echo '</div>';
        }
    }
endif;

/******************************************************/
