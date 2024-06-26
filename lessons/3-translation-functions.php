<?php

//basic
echo __('Hello World', '_themename') ?>
<?php
//translatable sentence with built-in echo.
_e('Hello World', '_themename') ?>

<?php
//translatable sentence with built-in echo and esc_html.
esc_html_e('Hello World', '_themename') ?>


<?php
//Giving context for word
_x('Post', 'verb', '_themename'); ?>

<?php
//translatable sentences with dynamic data with sanitization.
$country = 'London';
printf(
    /* translators: %s is country */
    esc_html__('You are in %s', '_themename'),
    $country,
); ?>


<?php
//translatable sentences with dynamic data singular/plural with sanitization.
$comments = 10;
printf(
    /* translators: %s is comments */
    esc_html(
        _n(
            '1 comment',
            '%s comments',
            $comments,
            '_themename'
        ),
    ),
    $comments
) ?>


<?php
//translatable sentences with dynamic data that is a html element.
printf(
    /* translators: %s is post link */
    esc_html__(
        'Posted by %s',
        '_themename',
    ),
    '<a href=" ' . get_permalink() . ' ">Mark Dio</a>'
); ?>


<?php
//translatable sentences with html element with dynamic data that is a html element.
// we use wp_kses as replacement for esc_html to specify what element should not be stripped.
printf(
    /* translators: %s is post link */
    wp_kses(
        __(
            'Posted by <h1 class="mamaloan">%s</h1>',
            '_themename',
        ),
        [
            'h1' => [
                'class' => []
            ]
        ],
    ),
    '<a href=" ' . get_permalink() . ' ">Mark Dio</a>'
);
?>