<?php


//General Options
$wp_customize->add_section('_themename_general_options', array(
    'title' => esc_html__('General Options', '_themename'),
    'description' => esc_html__('You can change general options from here.', '_themename')
));

//Accent Color
$wp_customize->add_setting('_themename_accent_colour', array(
    'default' => '#20ddae',
    'transport' => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, '_themename_accent_colour', array(
    'label' => __('Accent Color', '_themename'),
    'section' => '_themename_general_options',
)));

// Portfolio Slug
$wp_customize->add_setting('_themename_portfolio_slug', array(
    'default'           => 'portfolio',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('_themename_portfolio_slug', array(
    'type'    => 'text',
    'label'    => esc_html__('Portfolio Slug', '_themename'),
    'description' => esc_html__('Will appear in the archive url', '_themename'),
    'section'  => '_themename_general_options',
));
