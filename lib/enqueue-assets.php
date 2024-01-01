<?php

function _dionnietheme_assets()
{
    wp_enqueue_style('dionnietheme-stylesheet',  get_template_directory_uri() . '/dist/css/bundle.css');
    wp_enqueue_style('dionnietheme-bootstrap',  get_template_directory_uri() . '/dist/vendors/bootstrap-5.0.2-dist/css/bootstrap.min.css');
    wp_enqueue_script('dionnietheme-scripts',  get_template_directory_uri() . '/dist/js/bundle.js', array('jquery'), '1.0.0', true);
    wp_enqueue_style('dionnietheme-scripts',  get_template_directory_uri() . '/dist/vendors/bootstrap-5.0.2-dist/js/bootstrap.min.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', '_dionnietheme_assets');