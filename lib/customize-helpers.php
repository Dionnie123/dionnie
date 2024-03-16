<?php




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
