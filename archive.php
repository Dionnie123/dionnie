<?php

get_header();
?>
<div class="c-archive-page-header container  mt-3">
    <header>
        <div class="card p-3 d-flex justify-content-center">
            <?php the_archive_title('<h2>', '</h2>') ?>
            <?php the_archive_description('<p>', '</p>') ?>
        </div>
    </header>
</div>

<?php


$args = array(
    'post_type' => 'post',
    'posts_per_page' => 12,
    'paged' => $paged,
    'ignore_sticky_posts' => 1,
    'orderby' => $_GET['orderby'] ?? 'date',
    'order' =>  $_GET['order'] ?? 'DESC',
    's' => $_GET['s'] ?? ''
);
$args['category_name'] = get_query_var('category_name') ?? null;
$query = new WP_Query($args); ?>
<?php get_template_part('template-parts/post/filter'); ?>

<main role="main">
    <div class="container">
        <div class="row">
            <div class=" <?php echo is_active_sidebar('primary-sidebar') ?  'col-lg-9' : 'col-lg-12'   ?> ">
                <?php if ($query->have_posts()) : ?>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 gx-3 gy-3">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <?php get_template_part('template-parts/post/content', 'archive'); ?>
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

            <?php if (is_active_sidebar('primary-sidebar')) { ?>
                <div class="col-lg-3">
                    <div class="card p-3">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
<?php wp_reset_postdata(); ?>

<?php



get_footer();
