<?php
/**
 * Created for kolehad.org
 * Author: Itay Banner
 * Author website: http://ibanner.co.il
 * Date: 07/06/2017
 * Time: 16:14
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/*-------------------------------------------------------------------------------
	UPLOAD VALIDATION
-------------------------------------------------------------------------------*/

add_action('save_post', 'exodus_validate_thumbnail_size');

function exodus_validate_thumbnail_size($post_id) {

    // Only validate post type of post
    if( get_post_type( $post_id ) != 'post' )
        return;

    // Only validate if featured image is set
    if ( !has_post_thumbnail( $post_id ) )
        return;

    // Check post has a thumbnail
    $thumb = get_post_thumbnail_id( $post_id );
    $tsize = wp_get_attachment_image_src( $thumb , 'full' );


    if ( $tsize[1] < 1170 ) {
        // Confirm validate thumbnail has failed
        set_transient( "exodus_validate_thumbnail_size_failed", "true" );

        // Remove this action so we can resave the post as a draft and then reattach the post
        remove_action('save_post', 'exodus_validate_thumbnail_size');
        delete_post_thumbnail( $post_id );
        add_action('save_post', 'exodus_validate_thumbnail_size');
    } else {
        // If the post has a thumbnail delete the transient
        delete_transient( "exodus_validate_thumbnail_size_failed" );
    }
}

add_action('admin_notices', 'exodus_validate_thumbnail_size_error');




function exodus_validate_thumbnail_size_error() {
    // check if the transient is set, and display the error message
    if ( get_transient( "exodus_validate_thumbnail_size_failed" ) == "true" ) {
        echo "<div id='message' class='error'><p><strong>" . __('The Featured image you set was too small and was removed. Please set another image, at least 1170px wide!' , 'exodus' ) . "</strong></p></div>";
        delete_transient( "exodus_validate_thumbnail_size_failed" );
    }
}
