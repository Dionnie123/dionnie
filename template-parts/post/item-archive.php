<article <?php post_class('c-post col') ?>>
    <div class="card h-100">
        <?php if (has_post_thumbnail()) : ?>
            <img style="min-height: 180px;max-height: 180px; object-fit: cover;" src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php echo esc_attr(get_the_title() ?: 'Post Thumbnail'); ?>">
        <?php else : ?>
            <img style="min-height: 180px;max-height: 180px; object-fit: cover;" src="<?php echo esc_url(get_template_directory_uri()) . '/dist/assets/images/post-placeholder.webp'; ?>" class="card-img-top mh-50" alt="Placeholder Image">
        <?php endif; ?>
        <div class="card-body">
            <h5 class="card-title"><?php esc_html(the_title()); ?></h5>
            <p class="card-text">
                <?php echo wp_kses_post(wp_trim_words(get_the_excerpt(), 15)); // Limit excerpt to 15 words 
                ?>
            </p>

            <a href="<?php esc_url(the_permalink());  ?>" class="btn btn-secondary btn-sm">
                <span class="btn-label"><i class="fa fa-check"></i></span>&nbsp;Read more </a>
        </div>
    </div>
</article>