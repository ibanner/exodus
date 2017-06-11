<?php
/**
 * Created for kolehad.org
 * Author: Itay Banner
 * Author website: http://ibanner.co.il
 * Date: 08/06/2017
 * Time: 09:55
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/******************************************************/

//TODO to be deprecated
if ( ! function_exists( 'exodus_flexslider' )) :
    function exodus_flexslider() {

        if( have_rows('hero_slides' , 'options') ):
            echo '<div class="flexslider">
                <ul class="slides">';
            while( have_rows('hero_slides' , 'options') ): the_row();
                // vars
                $title = get_sub_field('title');
                $sub_title = get_sub_field('sub-title');
                $image = get_sub_field('slide_image');
                if (!empty(get_sub_field('target_category'))) {
                    $target = get_category_link(get_sub_field('target_category'));
                } else {
                    $target = get_the_permalink(get_sub_field('target_article'));
                }

                echo '<li>';
                echo '<div class="slide-caption">';
                echo '<h1>' . $title . '</h1>';
                echo '<p>' . $sub_title . '</p>';
                echo '</div>';
                echo '<a href="' . $target . '"><img src="' . $image . '" /></a>';
                echo '</li>';
            endwhile;
            echo '</ul>';
            echo '</div>';
        elseif (is_rtl()) :
            echo '<div class="flexslider flexslider-empty">';
            echo '<div class="slide-caption">';
            echo '<h1>רגע, רגע</h1>';
            echo '<p>פה יהיה אפשר להציג סליידר מגניב בעברית אם רק יהיה תוכן מתורגם</p>';
            echo '</div></div>';
        endif;
    }
endif;

