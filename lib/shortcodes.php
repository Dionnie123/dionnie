<?php
function current_year_shortcode()
{
    $currentYear = date('Y');
    return '<h1>' . $currentYear . '</h1>';
}

add_shortcode('current_year', 'current_year_shortcode');
//   <?php echo do_shortcode('[current_year]');