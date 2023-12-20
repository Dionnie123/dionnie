<?php
require 'app/vendor/autoload.php';

use CNZ\Helpers\Util as Util;

class MyHelper
{
    public static function is_string_in_array($needle, $haystack = [])
    {
        $haystack_lower = array_map('strtolower', $haystack);
        $needle_lower = strtolower($needle);
        $index = array_search($needle_lower, $haystack_lower, true);
        return $index !== false;
    }

    public static function get_value($param_name, $allowed_values = [], $default_value = '')
    {
        // Check if the parameter exists in the URL
        if (isset($_GET[$param_name])) {
            // Sanitize and return the value
            if (!empty($allowed_values)) {
                if (self::is_string_in_array($_GET[$param_name], $allowed_values)) {
                    return sanitize_text_field($_GET[$param_name]);
                }
            } else {
                return sanitize_text_field($_GET[$param_name]);
            }
        } else {
            // If the parameter is not set, return a default value or false
            return $default_value; // Or return a default value like: return 'default_value';
        }
    }

    public static function bootstrap_pagination($wp_query = false, $echo = true, $args = [])
    {
        //Fallback to $wp_query global variable if no query passed
        if ($wp_query === false) {
            global $wp_query;
        }
        $big = 999999999;
        $default = [
            'post_type' => 'post',
            'posts_per_page' => 6,
            'base' => str_replace($big, '%#%', get_pagenum_link($big)),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'prev_text' => __('← Previous'),
            'next_text' => __('Next  →'),
            'type' => 'list',
            'show_all' => false,
            'end_size' => 2,
            'mid_size' => 6,
            'ignore_sticky_posts' => 1,
            'total' => $wp_query->max_num_pages,
        ];

        $args = array_replace($default, $args);
        $listString = paginate_links($args);

        // Replace classes and modify pagination structure
        $listString = str_replace("<ul class='page-numbers'>", '<ul class="pagination justify-content-center mt-5">', $listString);
        $listString = str_replace('page-numbers', 'page-link', $listString);
        $listString = str_replace('<li>', '<li class="page-item">', $listString);
        $listString = str_replace(
            '<li class="page-item"><span aria-current="page" class="page-link current">',
            '<li class="page-item active"><span aria-current="page" class="page-link">',
            $listString
        );

        if ($echo) {
            echo $listString;
        } else {
            return $listString;
        }
    }
}