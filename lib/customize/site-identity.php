<?php

//Site Title
$wp_customize->get_setting('blogname')->transport = 'postMessage';

$wp_customize->selective_refresh->add_partial('blogname_partial', array(
    'settings' => array('blogname'),
    'selector' => '.c-header__blogname',
    'container_inclusive' => true,
    'render_callback' => function () {
        bloginfo('name');
    }
));
