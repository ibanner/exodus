<?php

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
