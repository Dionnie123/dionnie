<?php




//require('customize-helpers.php');


function _themename_customize_register($wp_customize)
{





    /*---------------------------------------------------------------------------
* Start of Footer Options
*---------------------------------------------------------------------------*/

    $wp_customize->add_setting('nav_menus', array(
        'selector' => '.header-nav ',
        'container_inclusive' => false,
    ));

    $wp_customize->selective_refresh->add_partial('_themename_footer_partial', array(
        'settings' => array('_themename_footer_bg', '_themename_footer_layout'),
        'selector' => '#footer',
        'container_inclusive' => false,
        'render_callback' => function () {
            get_template_part('template-parts/footer/widgets');
            get_template_part('template-parts/footer/info');
        }
    ));

    $wp_customize->add_section('_themename_footer_options', array(
        'title' => esc_html__('Footer Options', '_themename'),
        'description' => esc_html__('You can change footer options from here.', '_themename')
    ));

    /*---------------------------------------------------------------------------
* Site Info
*---------------------------------------------------------------------------*/

    $wp_customize->add_setting('_themename_site_info', array(
        'default' => '',
        'sanitize_callback' => '_themename_sanitize_site_info',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control('_themename_site_info', array(
        'type' => 'text',
        'label' => esc_html__('Site Info', '_themename'),
        'section' => '_themename_footer_options'
    ));




    /*---------------------------------------------------------------------------
* Footer Background
*---------------------------------------------------------------------------*/
    $wp_customize->add_setting('_themename_footer_bg', array(
        'default' => 'dark',
        'transport' => 'postMessage',
        'sanitize_callback' => '_themename_sanitize_footer_bg'
    ));

    $wp_customize->add_control('_themename_footer_bg', array(
        'type' => 'select',
        'label' => esc_html__('Footer Background', '_themename'),
        'choices' => array(
            'light' => esc_html__('Light', '_themename'),
            'dark' => esc_html__('Dark', '_themename'),
        ),
        'section' => '_themename_footer_options'
    ));








    /*---------------------------------------------------------------------------
* Footer Layout
*---------------------------------------------------------------------------*/
    $wp_customize->add_setting('_themename_footer_layout', array(
        'default' => '3,3,3,3',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
        'validate_callback' => '_themename_validate_footer_layout'
    ));

    $wp_customize->add_control('_themename_footer_layout', array(
        'type' => 'text',
        'label' => esc_html__('Footer Layout', '_themename'),
        'section' => '_themename_footer_options'
    ));


    /*---------------------------------------------------------------------------
* End of Footer Options
*---------------------------------------------------------------------------*/



    $wp_customize->get_setting('blogname')->transport = 'postMessage';

    $wp_customize->selective_refresh->add_partial('blogname_partial', array(
        'settings' => array('blogname'),
        'selector' => '.c-header__blogname',
        'container_inclusive' => true,
        'render_callback' => function () {
            bloginfo('name');
        }
    ));


    /*##################  SINGLE SETTINGS ########################*/

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
}

/////////////////

function _themename_sanitize_footer_layout()
{
    $footer_layout = sanitize_text_field(get_theme_mod('_themename_footer_layout', '3,3,3,3'));
    $footer_layout = preg_replace('/\s+/', '', $footer_layout);
    $columns = explode(',', $footer_layout);
    return $columns;
}



function _themename_sanitize_checkbox($checked)
{

    return (isset($checked) && $checked === true) ? true : false;
}



function _themename_sanitize_footer_bg($input)
{
    $valid = array('light', 'dark');
    if (in_array($input, $valid, true)) {
        return $input;
    }
    return 'dark';
}





function _themename_sanitize_site_info($input)
{
    $allowed = array('a' => array(
        'class' => array(),
        'href' => array(),
        'title' => array()
    ));
    return wp_kses($input, $allowed);
}


add_action('customize_register', '_themename_customize_register');
