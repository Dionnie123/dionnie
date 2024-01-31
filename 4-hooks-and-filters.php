<?php
/*Hooks/Filters allows other developers to modify your code 
without actually touching your code and same case on Wordpress core
that allows you to modify their code without you editing the actual files*/


// Custom Hooks
function after_pagination()
{
    echo '<h1>After pagination</h1>';
}
add_action('_themename_after_pagination', 'after_pagination');
/*
USAGE:
<?php do_action('_themename_after_pagination') ?>
*/

// Wordpress Hooks
/* function paginitization($query)
{
if ($query->is_main_query()) {
$query->set('posts_per_page', 2);
}
}
add_action('pre_get_posts', 'paginitization', 10, 1); */



//Custom Filter
function no_posts_text($text)
{
return esc_html("WALA NA!!!");
}
add_filter('_themename_no_posts_text', 'no_posts_text', 10, 1);
/*
USAGE:
<h3><?php _e(apply_filters('_themename_no_posts_text',   esc_html("No Posts Found")), '_themename')  ?></h3>
*/

//Wordpress Filter
/* function filter_title($text)
{
return esc_html("Title: " . $text);
}
add_filter('the_title', 'filter_title', 10, 1); */

add_filter('wp_nav_menu_args', function ($args) {
if (isset($args['walker']) && is_string($args['walker']) && class_exists($args['walker'])) {
$args['walker'] = new $args['walker'];
}
return $args;
}, 1001);