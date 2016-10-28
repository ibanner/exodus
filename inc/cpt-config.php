<?php

add_action( 'init', 'exodus_register_my_cpts' );
function exodus_register_my_cpts() {
    $labels = array(
        "name" => __( 'Rituals', 'exodus' ),
        "singular_name" => __( 'Ritual', 'exodus' ),
        "menu_name" => __( 'Rituals', 'exodus' ),
        "all_items" => __( 'All Rituals', 'exodus' ),
        "add_new" => __( 'Add New', 'exodus' ),
        "add_new_item" => __( 'Add New Ritual', 'exodus' ),
        "edit_item" => __( 'Edit Ritual', 'exodus' ),
        "new_item" => __( 'New Ritual', 'exodus' ),
        "view_item" => __( 'View Ritual', 'exodus' ),
        "search_items" => __( 'Search Rituals', 'exodus' ),
        "not_found" => __( 'No Rituals Found', 'exodus' ),
        "not_found_in_trash" => __( 'No Rituals found in the trash', 'exodus' ),
        "parent_item_colon" => __( 'Parent Ritual:', 'exodus' )
    );

    $args = array(
        "label" => __( 'Rituals', 'exodus' ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => true,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "ritual", "with_front" => true ),
        "query_var" => true,
        "menu_position" => 5,"menu_icon" => "dashicons-awards",
        "supports" => array( 'title', 'author', 'thumbnail' , 'excerpt' , 'comments' ),
        "taxonomies" => array( "category" ),
    );
    register_post_type( "ritual", $args );

    $labels = array(
        "name" => __( 'Texts', 'exodus' ),
        "singular_name" => __( 'Text', 'exodus' ),
        "menu_name" => __( 'Texts', 'exodus' ),
        "all_items" => __( 'All Texts', 'exodus' ),
        "add_new" => __( 'Add New', 'exodus' ),
        "add_new_item" => __( 'Add New Text', 'exodus' ),
        "edit_item" => __( 'Edit Text', 'exodus' ),
        "new_item" => __( 'New Text', 'exodus' ),
        "view_item" => __( 'View Text', 'exodus' ),
        "search_items" => __( 'Search Text', 'exodus' ),
        "not_found" => __( 'No Texts found.', 'exodus' ),
        "not_found_in_trash" => __( 'No Texts found in the trash', 'exodus' ),
        "parent_item_colon" => __( 'Parent Text', 'exodus' )
    );

    $args = array(
        "label" => __( 'Texts', 'exodus' ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => true,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "text", "with_front" => true ),
        "query_var" => true,
        "menu_position" => 6,"menu_icon" => "dashicons-book-alt",
        "supports" => array( 'title', 'author', 'thumbnail' , 'excerpt' , 'comments' ),
        "taxonomies" => array( "category" ),
    );
    register_post_type( "text", $args );

// End of exodus_register_my_cpts()
}
