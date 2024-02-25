<?php
require_once(get_template_directory() . '/dist/lib/customize.php');
require_once(get_template_directory() . '/dist/lib/helpers.php');
require_once(get_template_directory() . '/dist/lib/theme-support.php');
require_once(get_template_directory() . '/dist/lib/enqueue-assets.php');
require_once(get_template_directory() . '/dist/lib/sidebars.php');
require_once(get_template_directory() . '/4-hooks-and-filters.php');
require_once(get_template_directory() . '/dist/lib/navigation.php');
require_once(get_template_directory() . '/dist/lib/post_service.php');



(new \_ThemeName\PostService)->registerActions();

function current_year_shortcode()
{
    $currentYear = date('Y');
    return '<h1>' . $currentYear . '</h1>';
}

add_shortcode('current_year', 'current_year_shortcode');
