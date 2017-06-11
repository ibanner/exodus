<?php
/**
 * Created for kolehad.org
 * Author: Itay Banner
 * Author website: http://ibanner.co.il
 * Date: 07/06/2017
 * Time: 15:59
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

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

function exodus_kses_post( $value ) {

    // is array
    if( is_array($value) ) {
        return array_map('exodus_kses_post', $value);
    }

    // return
    return wp_kses_post( $value );
}
add_filter('acf/update_value', 'exodus_kses_post', 10, 1);

/*******************************************/