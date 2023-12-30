<?php
function dionnietheme_assets()
{
    wp_enqueue_style('dionnietheme-stylesheet',  get_template_directory_uri() . '/dist/css/bundle.min.css');
    wp_enqueue_style('dionnietheme-bootstrap',  get_template_directory_uri() . '/dist/vendors/bootstrap-5.0.2-dist/css/bootstrap.min.css');
    wp_enqueue_script('dionnietheme-scripts',  get_template_directory_uri() . '/dist/js/bundle.min.js');
    wp_enqueue_style('dionnietheme-scripts',  get_template_directory_uri() . '/dist/vendors/bootstrap-5.0.2-dist/js/bootstrap.min.js');
}


add_action('wp_enqueue_scripts', 'dionnietheme_assets');
