<?php

// When a new user is registered, create their initial Siddur term
add_action( 'user_register' , 'exodus_create_siddur' , 10 , 1 );
function exodus_create_siddur($user_id) {
    $siddur = 'siddur_' . $user_id . '_1';
    if ( !term_exists( $siddur ) ) {
        wp_insert_term( $siddur , 'siddurim' , array('slug' => $siddur));
    }
}

/*******************************************/

if ( ! function_exists( 'exodus_siddur_action_handler' ) ) :
    /**
     * This function will handle clearing Siddur add/remove requests
     */
    function exodus_siddur_action_handler() {

        $alert = '';

        if (
            isset($_GET['sidaction']) &&
            isset($_GET['post_id']) &&
            isset($_GET['nonce'])
        ) {
            $siddur = 'siddur_' . get_current_user_id() . '_1';

            if (
                $_GET['sidaction'] === 'add' &&
                wp_verify_nonce($_GET['nonce'], 'exodus-siddur-add')
            ) {
                wp_set_object_terms( $_GET['post_id'] , $siddur , 'siddurim' , true );
            } elseif (
                $_GET['sidaction'] === 'remove' &&
                wp_verify_nonce($_GET['nonce'], 'exodus-siddur-remove')
            ) {
                wp_remove_object_terms( $_GET['post_id'] , $siddur , 'siddurim' );
            }

            // So how did it go?
            if ($_GET['sidaction'] === 'add' && has_term($siddur, 'siddurim' , $_GET['post_id'] )) {
                $alert = 'success_add';
            } elseif ($_GET['sidaction'] === 'remove' && !has_term($siddur, 'siddurim' , $_GET['post_id'])) {
                $alert = 'success_remove';
            } elseif ($_GET['sidaction'] === 'add' && !has_term($siddur, 'siddurim' , $_GET['post_id'])) {
                $alert = 'fail_add';
            } elseif ($_GET['sidaction'] === 'remove' && has_term($siddur, 'siddurim' , $_GET['post_id'])) {
                $alert = 'fail_remove';
            }
        }
        return $alert;
    }

endif;

/*******************************************/

if ( ! function_exists( 'exodus_siddur_button' ) ) :
    /**
     * Displays a toggle button to add/remove an item from the Siddur
     */
    function exodus_siddur_button() {
        $siddur = 'siddur_' . get_current_user_id() . '_1';

        $case = 'add';
        if (!is_user_logged_in()) {
            $case = 'anon';             // Anonymous User
        } elseif ( has_term( $siddur , 'siddurim' ) ) {
            $case = 'remove';           // Post exists in the Siddur
        }

        echo exodus_siddur_button_markup($case);
    }

endif;

/*******************************************/

/*
 * Construct the markup for the Siddur add/remove button
 */
function exodus_siddur_button_markup( $case ) {

    $template = '
    <a id="siddur-%1$s" class="article__meta--siddur input input--button btn btn-info" href="%2$s" title="%3$s" rel="nofollow">
        <i class="fa %4$s" aria-hidden="true"></i>
        %5$s
    </a>';

    $post_id = get_the_ID();
    $nonce = wp_create_nonce( 'exodus-siddur-' . $case );
    $url = '?sidaction=' . $case . '&post_id=' . $post_id . '&nonce=' . $nonce;
    $fa_class = 'fa-bookmark-o';
    $cta = __( 'Add to <b>My Siddur</b>' , 'exodus' );

    if ($case == 'anon') {
        $cta = __( 'Add to <b>My Siddur</b> <small>(Login)</small>' , 'exodus' );
        $url = wp_login_url(get_permalink() . '?sidaction=add&post_id=' . $post_id . '&nonce=' . $nonce);
    } elseif ($case == 'remove') {
        $fa_class = 'fa-bookmark';
        $cta = __( 'Remove from <b>My Siddur</b>' , 'exodus' );
    }

    return sprintf( $template, sanitize_html_class( $case ), esc_url($url) , sanitize_html_class( $cta ) , $fa_class , $cta );
}

/******************************************************/

if ( ! function_exists( 'exodus_siddur_toggle' ) ) :
    /**
     * Displays a toggle icon to add/remove an item from the Siddur - on archive pages.
     */
    function exodus_siddur_toggle() {
        $siddur = 'siddur_' . get_current_user_id() . '_1';

        $case = 'add';
        if (!is_user_logged_in()) {
            $case = 'anon';             // Anonymous User
        } elseif ( has_term( $siddur , 'siddurim' ) ) {
            $case = 'remove';           // Post exists in the Siddur
        }

        echo exodus_siddur_toggle_markup($case);
    }

endif;

/*******************************************/

/*
 * Construct the markup for the Siddur add/remove toggle icon - in archives
 */
function exodus_siddur_toggle_markup( $case ) {

    $template = '
    <a class="siddur-toggle siddur-toggle--%1$s" href="%2$s" title="%3$s" rel="nofollow" tooltip="%4$s">
        <i id="siddur-toggle" class="fa %5$s" aria-hidden="true"></i>
    </a>';

    $post_id = get_the_ID();
    $nonce = wp_create_nonce( 'exodus-siddur-' . $case );
    $url = '?sidaction=' . $case . '&post_id=' . $post_id . '&nonce=' . $nonce;
    $fa_class = 'fa-bookmark-o';
    $tooltip = __( 'Add to My Siddur' , 'exodus' );

    if ($case == 'anon') {
        $tooltip = __( 'Add to My Siddur (Login First)' , 'exodus' );
        $url = wp_login_url(get_permalink() . '?sidaction=add&post_id=' . $post_id . '&nonce=' . $nonce);
    } elseif ($case == 'remove') {
        $fa_class = 'fa-bookmark';
        $tooltip = __( 'Remove from My Siddur' , 'exodus' );
    }

    return sprintf( $template, sanitize_html_class( $case ), esc_url($url) , esc_html($tooltip) , esc_html($tooltip) , $fa_class );
}