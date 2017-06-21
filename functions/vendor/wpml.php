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

                if ( $l['active'] ) {

                    echo file_get_contents($l['country_flag_url']);
                    // echo '<img class="wpml-switch__flag wpml-switch__flag--active" src="' . $l['country_flag_url'] . '" height="32" alt="' . $l['language_code'] . '" width="32" />';

                } else {

                    echo '<a href="' . $l['url'] . '" class="wpml-switch__link">';
                    echo file_get_contents($l['country_flag_url']);
                    echo '</a>';

                }
            }

            echo '</div>';
        }
    }
endif;

/******************************************************/
