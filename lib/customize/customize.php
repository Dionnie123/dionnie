<?php






function _themename_customize_register($wp_customize)
{
    function _themename_sanitize_checkbox($checked)
    {
        return (isset($checked) && $checked === true) ? true : false;
    }

    require_once(get_template_directory() . '/lib/customize/single-post.php');
    require_once(get_template_directory() . '/lib/customize/site-identity.php');
    require_once(get_template_directory() . '/lib/customize/general-options.php');
    require_once(get_template_directory() . '/lib/customize/footer-options.php');
}


add_action('customize_register', '_themename_customize_register');
