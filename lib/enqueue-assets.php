<?php
function dionnietheme_assets()
{
    wp_enqueue_style('dionnietheme-stylesheet',  get_template_directory_uri() . '/dist/css/styles.min.css');
}


add_action('wp_enqueue_scripts', 'dionnietheme_assets');
