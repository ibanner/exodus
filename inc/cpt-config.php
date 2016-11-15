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
        "public" => false,
        "publicly_queryable" => true,
        "show_ui" => false,
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
        "public" => false,
        "publicly_queryable" => true,
        "show_ui" => false,
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

/*-------------------------------------------------------------------------------
	Set Admin Custom Columns
-------------------------------------------------------------------------------*/

// Set Custom Columns for "Text" CPT
add_filter('manage_text_posts_columns', 'set_custom_edit_text_columns');
add_action('manage_text_posts_custom_column', 'custom_text_columns', 10, 2);

function set_custom_edit_text_columns($new_columns) {
    // $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['id'] = __('ID');
    $new_columns['thumbnail'] = __('Thumbnail' , 'exodus' );
    $new_columns['excerpt'] = __('Excerpt' , 'exodus' );
    // $new_columns['title'] = _x('Text Title', 'column name');
    $new_columns['author'] = __('Author' , 'exodus' );
    $new_columns['categories'] = __('Categories' , 'exodus' );
    // $new_columns['date'] = _x('Date', 'column name');

    return $new_columns;
}

function custom_text_columns($column_name, $id) {
    switch ($column_name) {
        case 'id':
            echo $id;
            break;
        case 'thumbnail':
            echo the_post_thumbnail(array (100,100));
            break;
        case 'excerpt':
            echo the_excerpt();
            break;
        default:
            break;
    } // end switch
}

// Set Custom Columns for "Ritual" CPT
add_filter('manage_ritual_posts_columns', 'set_custom_edit_ritual_columns');
add_action('manage_ritual_posts_custom_column', 'custom_ritual_columns', 10, 2);

function set_custom_edit_ritual_columns($new_columns) {
    // $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['id'] = __('ID');
    $new_columns['thumbnail'] = __('Thumbnail' , 'exodus' );
    $new_columns['excerpt'] = __('Excerpt' , 'exodus' );
    // $new_columns['title'] = _x('Ritual Title', 'column name');
    $new_columns['author'] = __('Author' , 'exodus' );
    $new_columns['categories'] = __('Categories' , 'exodus' );
    // $new_columns['date'] = _x('Date', 'column name');

    return $new_columns;
}

function custom_ritual_columns($column_name, $id) {
    switch ($column_name) {
        case 'id':
            echo $id;
            break;
        case 'thumbnail':
            echo the_post_thumbnail(array (100,100));
            break;
        case 'excerpt':
            echo the_excerpt();
            break;
        default:
            break;
    } // end switch
}

/*-------------------------------------------------------------------------------
	Register "Post Types" Taxonomy
-------------------------------------------------------------------------------*/

add_action( 'init', 'exodus_register_post_types_tax' );
function exodus_register_post_types_tax()
{
    $labels = array(
        "name" => __('Post Types', 'exodus'),
        "singular_name" => __('Post Type', 'exodus'),
        "menu_name" => __( 'Post Types', 'exodus' ),
        "all_items" => __( 'All Post Types', 'exodus' ),
        "edit_item" => __( 'Edit Post Type', 'exodus' ),
        "view_item" => __( 'View Post Type', 'exodus' ),
        "update_item" => __( 'Update Post Type', 'exodus' ),
        "add_new_item" => __( 'Add New Post Type', 'exodus' ),
        "new_item_name" => __( 'New Post Type Name', 'exodus' ),
    );

    $args = array(
        "label" => __('Post Types', 'exodus'),
        "labels" => $labels,
        "public" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'type', 'with_front' => true,),
        "show_admin_column" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "show_in_quick_edit" => true,
        "capabilities"  => array(
            "manage_terms"  => "manage_options",
            "edit_terms"    => "manage_options",
            "delete_terms"  => "manage_options"
        ),
    );
    register_taxonomy("post_types_tax", array("post") , $args);
}


/*-------------------------------------------------------------------------------
	Register "My Siddur" Taxonomy
-------------------------------------------------------------------------------*/

add_action( 'init', 'exodus_register_my_siddur' );
function exodus_register_my_siddur()
{
    $labels = array(
        "name" => __('Siddurim', 'exodus'),
        "singular_name" => __('My Siddur', 'exodus')
    );

    $args = array(
        "label" => __('Siddurim', 'exodus'),
        "labels" => $labels,
        "public" => false,
        "hierarchical" => true,
        "capabilities"  => array(
            "manage_terms"  => "manage_siddurim",
            "edit_terms"    => "manage_siddurim",
            "delete_terms"  => "manage_siddurim"
        ),
        /*"show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,*/
        "query_var" => true,
        "rewrite" => array('slug' => 'siddur', 'with_front' => true,),
        "show_admin_column" => false,
        "show_in_rest" => false,
        "rest_base" => "",
        "show_in_quick_edit" => false,
    );
    register_taxonomy("siddurim", array("text","ritual","post"), $args);
}
