<article <?php post_class('c-post card'); ?>>

    <div class="c-post__inner">

        <?php if (get_the_post_thumbnail() !== '') { ?>
            <div class="c-post__thumbnail">
                <?php the_post_thumbnail('_themename-blog-image'); ?>
            </div>
        <?php } ?>

        <?php get_template_part('template-parts/post/single/header'); ?>

        <?php if (is_single()) { ?>
            <div class="c-post__content card-body">
                <?php
                the_content();
                wp_link_pages();
                ?>
            </div>
        <?php } else { ?>
            <div class="c-post__excerpt">
                <?php the_excerpt(); ?>
            </div>
        <?php } ?>

        <?php if (is_single()) { ?>
            <?php get_template_part('template-parts/post/single/footer'); ?>
        <?php } ?>
        <?php if (!is_single()) {
        } ?>
    </div>
</article>