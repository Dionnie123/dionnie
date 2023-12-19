<?php

function enqueue_bootstrap() {
    wp_enqueue_style('bootstrap-css',  get_template_directory_uri().'/app/plugins/bootstrap-5.3.2-dist/css/bootstrap.css');
    wp_enqueue_script('bootstrap-js',  get_template_directory_uri().'/app/plugins/bootstrap-5.3.2-dist/js/bootstrap.bundle.js', array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'enqueue_bootstrap');