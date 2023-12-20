<?php 
require 'app/vendor/autoload.php';
require 'MyHelper.php';

use CNZ\Helpers\Util as util;

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 12, 
    'paged' => $paged,
    'ignore_sticky_posts' => 1, 
    'orderby' => MyHelper::get_value('orderby', null, 'date'),
    'order' => MyHelper::get_value('order', ['ASC', 'DESC'], 'DESC'),
    's' => MyHelper::get_value('title_search', null, ''),
);

$categoryFilter = get_query_var('category_name');
if ($categoryFilter) {
    $args['category_name'] = $categoryFilter;
}

$query = new WP_Query($args);

get_template_part('post-filter');
?>

<div class="container">
    <?php if ($query->have_posts()) : ?>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 gx-3 gy-3">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
        <?php get_template_part('post-item'); ?>
        <?php endwhile; ?>
    </div>
    <?php MyHelper::bootstrap_pagination($query, true, $args); ?>
    <?php else : ?>
    <div class="container">
        <h3>No Posts Found</h3>
    </div>
    <?php endif; ?>
</div>
<?php wp_reset_postdata(); ?>