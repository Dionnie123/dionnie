<?php 
require 'app/vendor/autoload.php';
require 'MyHelper.php';
use CNZ\Helpers\Util as util;

$title = MyHelper::get_value('title_search', false, '') != '' ? "title_search=".MyHelper::get_value('title_search', false, '')."&" : '';

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 12, 
    'paged' => $paged,
    'ignore_sticky_posts' => 1, 
    'orderby' => MyHelper::get_value('orderby', false, 'date'),
    'order' => MyHelper::get_value('order', ['ASC', 'DESC'], 'DESC'),
    's' => MyHelper::get_value('title_search', false, ''),
  

);


$categoryFilter = get_query_var('category_name');
if ($categoryFilter) {
    $args['category_name'] = $categoryFilter;
}

$query = new WP_Query($args);


get_template_part('post-filter');




?>



<div class="container ">
    <?php

if ($query->have_posts()) :
?>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 gx-3 gy-3 mb-5">
        <?php
            while ($query->have_posts()) : $query->the_post();
            get_template_part('post-item');
            endwhile;
            wp_reset_postdata();
            ?>
    </div>
    <?php
        MyHelper::bootstrap_pagination($query, true, $args);
        ?>
    <?php
else : ?>
    <div class="container">
        <h3>No Posts Found</h3>
    </div>
</div>
<?php endif; ?>