<?php
/**
 * Created for kolehad.org
 * Author: Itay Banner
 * Author website: http://ibanner.co.il
 * Date: 07/06/2017
 * Time: 15:57
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/*******************************************/
/*             ALM Functions               */
/*******************************************/

add_filter( 'alm_debug', '__return_true' );

/*******************************************/

if (! function_exists( 'exodus_alm_query_ids' )) {

    function exodus_alm_query_ids($loop) {

        // 1. Setup vars

        $args_unordered = '';
        $args_ordered = '';
        $ids_unordered = array();
        $ids_ordered = array();

        // 2. Get the unordered posts first (menu_order = 0) into $ids_unordered

        if ($loop == 'my-siddur') {

            $curuser = get_current_user_id();
            $siddur = 'siddur_' . $curuser . '_1';
            $args_unordered = array(
                'post_type' => 'post',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'siddurim',
                        'field' => 'slug',
                        'terms' => $siddur,
                    ),
                ),
            );

        } elseif ($loop == 'index') {

            $args_unordered = array(
                'posts_per_page' => -1,
                'menu_order' => 0,
            );

        } elseif ($loop == 'cat') {

            $args_unordered = array(
                'posts_per_page' => -1,
                'cat' => get_query_var('cat'),
                'menu_order' => 0,
            );
        }

        $query_unordered = new WP_Query($args_unordered);

        while ($query_unordered->have_posts()) {
            $query_unordered->the_post();
            $ids_unordered[] = get_the_ID();
        }

        // 3. Get the ordered posts into $ids_ordered by filtering the unordered

        if ($loop == 'index') {

            $args_ordered = array(
                'posts_per_page' => -1,
                'post__not_in' => $ids_unordered,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            );

        } elseif ($loop == 'cat') {

            $args_ordered = array(
                'posts_per_page' => -1,
                'cat' => get_query_var('cat'),
                'post__not_in' => $ids_unordered,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            );

        }

        if ($loop != 'my-siddur') {

            $query_ordered = new WP_Query($args_ordered);

            while ($query_ordered->have_posts()) {
                $query_ordered->the_post();
                $ids_ordered[] = get_the_ID();
            }

            // 4. Merge $ids_ordered and $ids_unordered

            $ids = array_merge($ids_ordered,$ids_unordered);

        } else {

            $ids = $ids_unordered;

        }

        // 5. Implode and return

        $ids = implode(', ', $ids);
        wp_reset_postdata();

        return $ids;
    }
}
/*******************************************/

if (! function_exists('exodus_alm_shortcode')) {
    function exodus_alm_shortcode($ids,$type) {
        // Get params from URL
        $search = (isset($_GET['s'])) ? $_GET['s'] : '';
        $shortcode = '[ajax_load_more post_type="post" posts_per_page="12" images_loaded="true"'; // basic shortcode start
        //preloaded="true" preloaded_amount="12"

        // Start Building the shortcode

        if (is_search()) {

            $shortcode .= ' search="'. $search .'"';

        } elseif (is_author()) {

            $author = get_query_var('author');
            $shortcode .= ' author="'. $author .'"';

        } /*elseif (is_category()) {

            $cat = get_query_var('cat');
            $category = get_category ($cat);
            $shortcode .= ' category="'. $category->slug .'"';

        }*/ elseif (isset($ids)) {
            $shortcode .= ' post__in="'.$ids.'" orderby="post__in"';
        }

        if (!empty($type)) {
            $shortcode .= ' taxonomy="post_types_tax" taxonomy_terms="'. $type .'" taxonomy_operator="IN"';
        }

        $button_label = __('Older Items' , 'exodus');
        $shortcode .= ' button_label="'. $button_label .'"]';

        echo do_shortcode($shortcode);
    }
}