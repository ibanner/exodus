<?php
/**
 * Created for kolehad.org
 * Author: Itay Banner
 * Author website: http://ibanner.co.il
 * Date: 29/06/2017
 * Time: 18:56
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'exodus_user_information',
        'title' => esc_html__('User Information', 'exodus'),
        'fields' => array (
            array (
                'key' => 'field_5820857820158',
                'label' => esc_html__('Profile', 'exodus'),
                'name' => 'profile',
                'type' => 'textarea',
                'instructions' => esc_html__('Share something about yourself!', 'exodus'),
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => 10,
                'new_lines' => 'wpautop',
            ),
            array (
                'key' => 'field_582085a620159',
                'label' => esc_html__('Gender', 'exodus'),
                'name' => 'gender',
                'type' => 'radio',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'Female' => esc_html__('Female', 'exodus'),
                    'Male' => esc_html__('Male', 'exodus'),
                ),
                'allow_null' => 0,
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => '',
                'layout' => 'horizontal',
                'return_format' => 'value',
            ),
            array (
                'key' => 'field_582085f22015a',
                'label' => esc_html__('Date of Birth', 'exodus'),
                'name' => 'date_of_birth',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'user_form',
                    'operator' => '==',
                    'value' => 'edit',
                ),
                array (
                    'param' => 'current_user',
                    'operator' => '==',
                    'value' => 'logged_in',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'left',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));

    acf_add_local_field_group(array (
        'key' => 'exodus_featured_video',
        'title' => esc_html__('Featured Video', 'exodus'),
        'fields' => array (
            array (
                'key' => 'field_5816ee6e240d6',
                'label' => esc_html__('Featured Video', 'exodus'),
                'name' => 'featured_video',
                'type' => 'oembed',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'width' => 1170,
                'height' => 658,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'side',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));

endif;