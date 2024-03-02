<?php
function _themename_the_custom_logo()
{

    if (has_custom_logo()) {

        echo get_custom_logo();
    } else {
        echo '<h1>' . get_bloginfo('name') . '</h1>';
    }
}

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
    $args = array_replace($default,  is_array($args) ? $args : []);
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

/*
USAGE:
$likes = 5;
echo countable_text('1 like', '%s likes', $likes);
*/
function countable_text($singular, $plural, $count)
{
    return sprintf(
        /* translators: %s is comments */
        esc_html(
            _n(
                $singular,
                $plural,
                $count,
                '_themename'
            )
        ),
        $count
    );
}





function _themename_readmore_link()
{
    echo '<a class="c-post__readmore" href="' . esc_url(get_permalink()) . '" title="' . the_title_attribute(['echo' => false]) . '">';
    /* translators: %s: Post Title */
    printf(
        wp_kses(
            __('Read More <span class="u-screen-reader-text">About %s</span>', '_themename'),
            [
                'span' => [
                    'class' => []
                ]
            ]
        ),
        get_the_title()
    );
    echo '</a>';
}


function _themename_private_metakey($text)
{
    // Check if the text starts with an underscore
    if (substr($text, 0, 1) === '_') {
        // Replace consecutive underscores with a single underscore
        $text = preg_replace('/_+/', '_', $text, 1);
    } else {
        // Add a single underscore at the beginning
        $text = '_' . $text;
    }

    return $text;
}