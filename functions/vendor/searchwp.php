<?php
/**
 * Created for kolehad.org
 * Author: Itay Banner
 * Author website: http://ibanner.co.il
 * Date: 06/11/2017
 * Time: 15:05
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

function exodus_searchwp_extra_metadata( $extra_meta, $post_being_indexed ) {

    // available author meta: http://codex.wordpress.org/Function_Reference/get_the_author_meta

    // retrieve the author's name(s)
    $author_nicename      = get_the_author_meta( 'user_nicename', $post_being_indexed->post_author );
    $author_display_name  = get_the_author_meta( 'display_name', $post_being_indexed->post_author );
    $author_nickname      = get_the_author_meta( 'nickname', $post_being_indexed->post_author );
    $author_first_name    = get_the_author_meta( 'first_name', $post_being_indexed->post_author );
    $author_last_name     = get_the_author_meta( 'last_name', $post_being_indexed->post_author );

    // grab the author bio
    $author_bio           = get_the_author_meta( 'description', $post_being_indexed->post_author );

    // index the author name and bio with each post
    $extra_meta['exodus_author_meta_nicename']     = $author_nicename;
    $extra_meta['exodus_author_meta_display_name'] = $author_display_name;
    $extra_meta['exodus_author_meta_nickname']     = $author_nickname;
    $extra_meta['exodus_author_meta_first_name']   = $author_first_name;
    $extra_meta['exodus_author_meta_last_name']    = $author_last_name;
    $extra_meta['exodus_author_meta_bio']          = $author_bio;

    return $extra_meta;
}
add_filter( 'searchwp_extra_metadata', 'exodus_searchwp_extra_metadata', 10, 2 );

function exodus_searchwp_author_meta_keys( $keys )
{
    // the keys we used to store author meta (see https://gist.github.com/jchristopher/8558947 for more info)
    $exodus_custom_author_meta_keys = array(
        'exodus_author_meta_nicename',
        'exodus_author_meta_display_name',
        'exodus_author_meta_nickname',
        'exodus_author_meta_first_name',
        'exodus_author_meta_last_name',
        'exodus_author_meta_bio'
    );

    // merge exodus custom meta keys with the existing keys
    $keys = array_merge( $keys, $exodus_custom_author_meta_keys );

    // make sure there aren't any duplicates
    $keys = array_unique( $keys );

    return $keys;
}

add_filter( 'searchwp_custom_field_keys', 'exodus_searchwp_author_meta_keys', 10, 1 );