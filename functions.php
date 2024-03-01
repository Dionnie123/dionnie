<?php
require_once(get_template_directory() . '/dist/lib/customize.php');
require_once(get_template_directory() . '/dist/lib/helpers.php');
require_once(get_template_directory() . '/dist/lib/theme-support.php');
require_once(get_template_directory() . '/dist/lib/enqueue-assets.php');
require_once(get_template_directory() . '/dist/lib/hooks/post-hooks.php');
require_once(get_template_directory() . '/dist/lib/hooks/footer-hooks.php');
require_once(get_template_directory() . '/dist/lib/sidebars.php');
require_once(get_template_directory() . '/dist/lib/navigation.php');
require_once(get_template_directory() . '/dist/lib/post_service.php');
require_once(get_template_directory() . '/dist/lib/include-plugins.php');



(new \_ThemeName\PostService)->registerActions();

function current_year_shortcode()
{
    $currentYear = date('Y');
    return '<h1>' . $currentYear . '</h1>';
}

add_shortcode('current_year', 'current_year_shortcode');

//Menu Custom Walker fix
add_filter('wp_nav_menu_args', function ($args) {
    if (isset($args['walker']) && is_string($args['walker']) && class_exists($args['walker'])) {
        $args['walker'] = new $args['walker'];
    }
    return $args;
}, 1001);
