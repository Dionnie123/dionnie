<?php
require_once(get_template_directory() . '/lib/customize.php');
require_once(get_template_directory() . '/lib/helpers.php');
require_once(get_template_directory() . '/lib/theme-support.php');
require_once(get_template_directory() . '/lib/enqueue-assets.php');
require_once(get_template_directory() . '/lib/hooks/post-hooks.php');
require_once(get_template_directory() . '/lib/hooks/footer-hooks.php');
require_once(get_template_directory() . '/lib/sidebars.php');
require_once(get_template_directory() . '/lib/navigation.php');
require_once(get_template_directory() . '/lib/post-service.php');
require_once(get_template_directory() . '/lib/menu-service.php');
require_once(get_template_directory() . '/lib/include-plugins.php');

require_once(get_template_directory() . '/lib/post-metaboxes.php');

function current_year_shortcode()
{
    $currentYear = date('Y');
    return '<h1>' . $currentYear . '</h1>';
}

add_shortcode('current_year', 'current_year_shortcode');
