<?php
function is_string_in_array($needle, $haystack = [])
{
    $haystack_lower = array_map('strtolower', $haystack);
    $needle_lower = strtolower($needle);
    $index = array_search($needle_lower, $haystack_lower, true);
    return $index !== false;
}

/**
 * Creates Pagination element from bootstrap framework
 * 
 * @param WP_Query $query   Used to query and retrieve posts from the WordPress database
 * @param array $args       Associative array to override default pagination settings
 * 
 */
function bootstrap_pagination($query = null, $args = [])
{
    //Fallback to $query global variable if no query passed
    if ($query === false) {
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
        'total' => $query->max_num_pages,
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

    echo $listString ?? null;

 
}

?>