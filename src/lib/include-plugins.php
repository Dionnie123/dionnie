<?php

require_once get_template_directory() . '/dist/lib/class-tgm-plugin-activation.php';

add_action('tgmpa_regsiter', '_themename_register_required_plugins');


function _themename_register_required_plugins(){
    $plugin = array(
        array(
            'name' => 'dionnie wp',
            'slug' => 'dionnie-wp', 
            'source' => get_template_directory_uri() . '/plugins/dionnie-wp.zip', 
            'required' => true, 
            'version' => '1.0.0', 
            'force_activation' = false,
            'force-deactivation' = false, 
        )
    ); 
    $config = array();

    tgmpa()
}