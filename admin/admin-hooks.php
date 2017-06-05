<?php
/**
 * Created by PhpStorm.
 * Author: Itay Banner
 * Date: 05/06/2017
 * Time: 12:33
 */

/*-------------------------------------------------------------------------------
	MODIFY POST LIST COLUMNS
-------------------------------------------------------------------------------*/

// 1. ADD & REMOVE COLUMNS

function exodus_hack_post_columns($columns) {

    unset( $columns['tags'] );
    unset( $columns['categories'] );
    unset( $columns['taxonomy-post_types_tax'] );
    unset( $columns['comments'] );
    unset( $columns['date'] );

    $columns['post_ID'] =  __( 'Post ID', 'exodus' );
    $columns['display_order'] =  __( 'Order', 'exodus' );
    $columns['taxonomy-post_types_tax'] =  __( 'Type', 'exodus' );
    $columns['categories'] =  __( 'Categories', 'exodus' );
    $columns['date'] =  __( 'Date', 'exodus' );

    return $columns;
}
add_filter('manage_posts_columns' , 'exodus_hack_post_columns');

// 2. DISPLAY DATA FOR NEW COLUMNS

add_action( 'manage_posts_custom_column' , 'exodus_posts_custom_columns', 5 , 2 );

function exodus_posts_custom_columns( $column, $post_id ) {
    switch ( $column ) {

        // display the post's ID
        case 'post_ID' :
            echo $post_id;
            break;

        // display the post's menu_order value
        case 'display_order' :
            $value = get_post_field( 'menu_order', $post_id );
            echo $value;
            break;

    }
}

// 3. ADD SORTABILITY

add_filter( 'manage_edit-post_sortable_columns', 'set_custom_post_sortable_columns' );

function set_custom_post_sortable_columns( $columns ) {
    $columns['display_order'] = 'menu_order';

    return $columns;
}