<?php


$postService = new \_ThemeName\PostService;
$query = $postService->getAll();





get_template_part('template-parts/post/filter'); ?>
<main role="main">
    <div class="container">
        <div class="row">
            <div class=" <?php echo is_active_sidebar('primary-sidebar') ?  'col-lg-9' : 'col-lg-12'   ?> ">
                <?php if ($query->have_posts()) : ?>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 gx-3 gy-3">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <?php get_template_part('template-parts/post/item', 'index'); ?>
                        <?php endwhile; ?>
                    </div>
                    <?php bootstrap_pagination($query, $postService->args()) ?>
                <?php else : ?>
                    <div class="container no-posts">
                        <h3><?php _e(apply_filters('_themename_no_posts_text',   esc_html("No Posts Found")), '_themename')  ?>
                        </h3>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (is_active_sidebar('primary-sidebar')) { ?>
                <div class="col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</main>

<?php wp_reset_postdata(); ?>