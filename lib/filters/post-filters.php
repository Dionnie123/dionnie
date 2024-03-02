<?php

function filter_title($text)
{
    return esc_html("Title: " . $text);
}
add_filter('the_title', 'filter_title', 10, 1);
