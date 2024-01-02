<?php

function _themename_assets()
{
    wp_enqueue_style('_themename-bootstrap',  get_template_directory_uri() . '/dist/vendors/bootstrap-5.0.2-dist/css/bootstrap.min.css');
    wp_enqueue_style('_themename-scripts',  get_template_directory_uri() . '/dist/vendors/bootstrap-5.0.2-dist/js/bootstrap.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_style('_themename-stylesheet',  get_template_directory_uri() . '/dist/css/bundle.css'); //this must be the last css to be added
    wp_enqueue_script('_themename-scripts',  get_template_directory_uri() . '/dist/js/bundle.js', array('jquery'), '1.0.0', true); //this must be the last js to be added
}
add_action('wp_enqueue_scripts', '_themename_assets');


function _themename_admin_assets()
{
    wp_enqueue_style('_themename-admin-stylesheet',  get_template_directory_uri() . '/dist/css/admin.css'); //this must be the last css to be added
    wp_enqueue_script('_themename-admin-scripts',  get_template_directory_uri() . '/dist/js/admin.js', array('jquery'), '1.0.0', true); //this must be the last js to be added
}
add_action('wp_enqueue_scripts', '_themename_admin_assets');
