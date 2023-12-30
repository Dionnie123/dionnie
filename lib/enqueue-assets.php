<?php
function dionnietheme_assets()
{
    wp_enqueue_style('dionnietheme-stylesheet',  get_template_directory_uri() . '/dist/css/bundle.min.css');
    wp_enqueue_script('dionnietheme-stylesheet',  get_template_directory_uri() . '/dist/js/bundle.min.js');
}


add_action('wp_enqueue_scripts', 'dionnietheme_assets');
