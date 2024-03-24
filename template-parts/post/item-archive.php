<article <?php post_class('c-post col') ?>>
    <div class="card h-100">
        <?php echo do_shortcode('[elementor-template id="2234"]') ?>
        <?php if (has_post_thumbnail()) : ?>
        <img style="min-height: 180px;max-height: 180px; object-fit: cover;"
            src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top"
            alt="<?php echo esc_attr(get_the_title() ?: 'Post Thumbnail'); ?>">
        <?php else : ?>
        <img style="min-height: 180px;max-height: 180px; object-fit: cover;"
            src="<?php echo esc_url(get_template_directory_uri()) . '/dist/assets/images/post-placeholder.jpg'; ?>"
            class="card-img-top mh-50" alt="Placeholder Image">
        <?php endif; ?>

        <div class="card-body">
            <h5 class="card-title"><?php esc_html(the_title()); ?></h5>
            <p class="card-text">
                <?php echo wp_kses_post(wp_trim_words(get_the_excerpt(), 15)); // Limit excerpt to 15 words 
                ?>
            </p>

            <?php
            $post_date = get_the_date('Y-m-d H:i:s');
            $relative_time = human_time_diff(strtotime($post_date), current_time('timestamp')) . ' ago';
            ?>

            <p>Published Item archive <?php echo $relative_time; ?></p>


            <button type="button" class="btn btn-sm btn-primary position-relative">
                Comments
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?php echo countable_text('1', '%s', get_comments_number()); ?>
                    <span class="visually-hidden">comments</span>
                </span>
            </button>

            <?php get_template_part('template-parts/post/loop-item/button-readmore',) ?>
            <?php get_template_part('template-parts/post/loop-item/button-delete',) ?>
            <?php get_template_part('template-parts/post/loop-item/table-metabox',) ?>
        </div>
    </div>
</article>