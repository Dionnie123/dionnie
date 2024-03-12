<?php
function _themename_sanitize_footer_layout()
{
    $footer_layout = sanitize_text_field(get_theme_mod('_themename_footer_layout', '3,3,3,3'));
    $footer_layout = preg_replace('/\s+/', '', $footer_layout);
    $columns = explode(',', $footer_layout);
    return $columns;
}

function _themename_footer_layout_validator($validity, $value)
{
    if (!preg_match('/^([1-9]|1[012])(,([1-9]|1[012]))*$/', $value)) {
        $validity->add('invalid_footer_layout', esc_html__('Footer layout is invalid', '_themename'));
    }
    return $validity;
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
