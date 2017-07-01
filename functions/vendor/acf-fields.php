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
        'title' => 'User Information',
        'fields' => array (
            array (
                'key' => 'field_5820857820158',
                'label' => __('Profile', 'exodus'),
                'name' => 'profile',
                'type' => 'textarea',
                'instructions' => 'Share something about yourself!',
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
                'label' => __('Gender', 'exodus'),
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
                    'Female' => __('Female', 'exodus'),
                    'Male' => __('Male', 'exodus'),
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
                'label' => __('Date of Birth', 'exodus'),
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

endif;