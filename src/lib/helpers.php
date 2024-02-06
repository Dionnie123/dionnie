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


class Custom_Menu_Walker extends Walker_Nav_Menu
{

    function start_lvl(&$output, $depth = 0, $args = null)
    {
        // Add custom class to the <ul> at this level
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"c-navigation__sub-menu sub-menu-level-$depth\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = \null, $id = 0)
    {
        // Add custom class to each <li> item
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

        $atts = array();
        $atts['title']  = !empty($item->title) ? esc_attr($item->title) : '';
        $atts['target'] = !empty($item->target) ? esc_attr($item->target) : '';
        $atts['rel']    = !empty($item->xfn) ? esc_attr($item->xfn) : '';
        $atts['href']   = !empty($item->url) ? esc_attr($item->url) : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

        // You can add more customizations or classes as needed
    }

    function end_lvl(&$output, $depth = 0, $args = null)
    {
        // Add custom closing tag for the <ul> at this level
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    // Add this method to fix the compatibility issue
    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        // Add custom closing tag for the <li> item
        $output .= "</li>\n";
    }
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

function _themename_delete_post()
{
    $url = add_query_arg([
        'action' => '_themename_delete_post',
        'post' => get_the_ID(),
        'nonce' => wp_create_nonce('_themename_delete_post_' . get_the_ID())
    ], home_url());
    if (current_user_can('delete_post', get_the_ID())) {


        return   "<a href='" . esc_url($url)  . "' class='btn btn-danger btn-sm'>
<span class='btn-label'><i class='fa fa-trash'></i></span>&nbsp;" . esc_html__('Delete Post', '_themename') . " </a>";
    }
}

function _themename_handle_delete_post()
{

    if (isset($_GET['action']) && $_GET['action'] === '_themename_delete_post') {

        $nonce = !isset($_GET['nonce']) || !wp_verify_nonce($_GET['nonce'], '_themename_delete_post_' . $_GET['post']);

        if ($nonce) {

            return;
        }

        $post_id = isset($_GET['post']) ? $_GET['post'] : null;
        $post = get_post((int) $post_id);
        if (empty($post)) {
            return;
        }
        wp_trash_post($post_id);
        wp_safe_redirect(home_url());

        die;
    }
}
