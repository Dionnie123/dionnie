<?php

function _themename_assets()
{

    wp_enqueue_style('_themename-stylesheet',  get_template_directory_uri() . '/dist/assets/css/bundle.css', array(), rand(0, 9999), 'all'); //this must be the last css to be added
    wp_enqueue_script('_themename-scripts',  get_template_directory_uri() . '/dist/assets/js/bundle.js', array('jquery'), rand(0, 9999), true); //this must be the last js to be added



}
add_action('wp_enqueue_scripts', '_themename_assets');


function _themename_admin_assets()
{
    wp_enqueue_style('_themename-admin-stylesheet',  get_template_directory_uri() . '/dist/assets/css/admin.css'); //this must be the last css to be added
    wp_enqueue_script('_themename-admin-scripts',  get_template_directory_uri() . '/dist/assets/js/admin.js', array('jquery'), '1.0.0', true); //this must be the last js to be added
}
add_action('admin_enqueue_scripts', '_themename_admin_assets');

function _themename_customize_preview_js()
{
    wp_enqueue_script('_themename-cutomize-preview', get_template_directory_uri() . '/dist/assets/js/customize-preview.js', array('customize-preview', 'jquery'), '1.0.0', true);

    include(get_template_directory() . '/lib/inline-css.php');
    wp_localize_script('_themename-cutomize-preview', '_themename', array('inline-css' => $inline_styles_selectors));
}

add_action('customize_preview_init', '_themename_customize_preview_js');
