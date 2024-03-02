<?php

function no_posts_text($text)
{
    return esc_html("No posts found :(");
}
add_filter('_themename_no_posts_text', 'no_posts_text', 10, 1);
