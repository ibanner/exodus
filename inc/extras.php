<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Kol_Ehad
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function exodus_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}

add_filter( 'body_class', 'exodus_body_classes' );





/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */

function exodus_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}

add_action( 'wp_head', 'exodus_pingback_header' );





/**
 * Filter the excerpt length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */

function exodus_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'exodus_custom_excerpt_length', 999 );




/**
 * Filter the default comments form markup (name, email, url)
 *
 * @param array $fields the markup to replace th default one.
 * @return array (Maybe) modified markup.
 */

function exodus_comment_form_fields( $fields ) {

    $mod_fields = array();

    foreach ($fields as $slug => $field) {
        $field_class = 'input  input--' . esc_attr($slug);
        $mod_fields[] = str_replace('value="', 'class="' . $field_class . '" value="', $field);
    }

    return $mod_fields;
}

add_filter( 'comment_form_default_fields', 'exodus_comment_form_fields' );



/**
 * Filter the default comments form markup (comment textarea)
 *
 * @param array $defaults
 * @return array with modified default textarea markup.
 */

function exodus_comment_form_defaults( $defaults ) {

    $mod_defaults = $defaults;
    $class = 'input  input--';

    $mod_defaults['comment_field'] = str_replace('name="', 'class="' . $class . 'textarea" name="', $mod_defaults['comment_field']);
    $mod_defaults['submit_button'] = str_replace('type="', 'class="' . $class . 'button" type="', $mod_defaults['submit_button']);

    return $mod_defaults;
}

add_filter( 'comment_form_defaults', 'exodus_comment_form_defaults' );

