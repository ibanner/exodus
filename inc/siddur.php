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
                $_GET['sidaction'] === 'siddur-add' &&
                wp_verify_nonce($_GET['nonce'], 'siddur-add')
            ) {
                wp_set_object_terms( $_GET['post_id'] , $siddur , 'siddurim' , true );
            } elseif (
                $_GET['sidaction'] === 'siddur-remove' &&
                wp_verify_nonce($_GET['nonce'], 'siddur-remove')
            ) {
                wp_remove_object_terms( $_GET['post_id'] , $siddur , 'siddurim' );
            }

            // So how did it go?
            if ($_GET['sidaction'] === 'siddur-add' && has_term($siddur, 'siddurim' , $_GET['post_id'] )) {
                $alert = 'success_add';
            } elseif ($_GET['sidaction'] === 'siddur-remove' && !has_term($siddur, 'siddurim' , $_GET['post_id'])) {
                $alert = 'success_remove';
            } elseif ($_GET['sidaction'] === 'siddur-add' && !has_term($siddur, 'siddurim' , $_GET['post_id'])) {
                $alert = 'fail_add';
            } elseif ($_GET['sidaction'] === 'siddur-remove' && has_term($siddur, 'siddurim' , $_GET['post_id'])) {
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

        $case = 'siddur-';
        if (!is_user_logged_in()) {
            $case .= 'anon';             // Anonymous User
        } elseif ( has_term( $siddur , 'siddurim' ) ) {
            $case .= 'remove';           // Post exists in the Siddur
        } else {
            $case .= 'add';
        }

        echo exodus_siddur_button_markup($case);
    }

endif;

    /*
     * Construct the markup for the Siddur add/remove button
     */
    function exodus_siddur_button_markup( $case ) {

        $post_id = get_the_ID();
        $nonce = wp_create_nonce( $case );
        $query = '?sidaction=' . $case . '&post_id=' . $post_id . '&nonce=' . $nonce;

        $a_text = esc_html__( 'Add to My Siddur' , 'exodus' );

        $attr = array(
            'a_id'        => $case,
            'a_class'     => 'article-button article-button--fav',
            'a_href'      => get_permalink() . $query,
            'i_class'     => 'svg-post_meta-fav-',
        );

        switch ($case) {
            case 'siddur-remove':
                $attr['i_class'] .= 'selected';
                $a_text = esc_html__( 'Remove from My Siddur' , 'exodus' );
                break;
            case 'siddur-anon':
                $attr["a+href"] = wp_login_url( $attr["a+href"] );
                break;
            default:
                $attr['i_class'] .= 'notselected';
        }


        $markup = '<a id="' . $attr["a_id"] . '" class="' . $attr["a_class"] . '" href="' . $attr["a_href"] . '" title="' . $a_text . '" rel="nofollow" role="button">
            <i class="svg-bg svg-post_meta ' . $attr["i_class"] . '"></i><span class="sr-only">' . $a_text . '</span>
        </a>';

        return $markup;
    }