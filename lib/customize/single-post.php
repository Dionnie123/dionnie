<?php

$wp_customize->add_section('_themename_single_blog_options', array(
    'title' => esc_html__('Single Blog Options', '_themename'),
    'description' => esc_html__('You can change single blog options from here.', '_themename'),
    'active_callback' => '_themename_show_single_blog_section'
));

$wp_customize->add_setting('_themename_display_author_info', array(
    'default' => true,
    'transport' => 'postMessage',
    'sanitize_callback' => '_themename_sanitize_checkbox'
));

$wp_customize->add_control('_themename_display_author_info', array(
    'type' => 'checkbox',
    'label' => esc_html__('Show Author Info', '_themename'),
    'section' => '_themename_single_blog_options'
));

function _themename_show_single_blog_section()
{
    global $post;
    return is_single() && $post->post_type === 'post';
}
