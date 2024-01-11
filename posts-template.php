<?php

require_once get_template_directory() . '/helpers.php';

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 12,
    'paged' => $paged,
    'ignore_sticky_posts' => 1,
    'orderby' => $_GET['orderby'] ?? 'date',
    'order' =>  $_GET['order'] ?? 'DESC',
    's' => $_GET['title_search'] ?? ''
);
$args['category_name'] = get_query_var('category_name') ?? null;
$query = new WP_Query($args); ?>
<?php get_template_part('posts-filter'); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <?php if ($query->have_posts()) : ?>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 gx-3 gy-3">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                <?php get_template_part('post-item'); ?>
                <?php endwhile; ?>
            </div>
            <?php bootstrap_pagination($query, $args) ?>
            <?php do_action('_themename_after_pagination') ?>
            <?php else : ?>
            <div class="container no-posts">
                <h3><?php _e(apply_filters('_themename_no_posts_text',   esc_html("No Posts Found")), '_themename')  ?>
                </h3>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-3">
            <?php 
            
            //get_sidebar();
            dynamic_sidebar('primary-sidebar');
            
            ?>
        </div>
    </div>
</div>
<?php wp_reset_postdata(); ?>