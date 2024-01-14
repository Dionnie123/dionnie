<?php
function _themename_the_custom_logo()
{

    if (has_custom_logo()) {

        echo get_custom_logo();
    } else {
        echo '<h1>' . get_bloginfo('name') . '</h1>';
    }
}
