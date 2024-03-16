<article <?php post_class('c-post col') ?>>
    <div class="card h-100">



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

            <p>Published Item-index <?php echo $relative_time; ?></p>




            <div class="d-inline  gap-3">
                <button type="button" class="btn btn-sm btn-primary position-relative">
                    Comments
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo countable_text('1', '%s', get_comments_number()); ?>
                        <span class="visually-hidden">comments</span>
                    </span>
                </button>
                <?php get_template_part('template-parts/post/button-readmore',) ?>
                <?php get_template_part('template-parts/post/button-delete',) ?>

            </div>

            <?php get_template_part('template-parts/post/table-metabox',) ?>
        </div>
    </div>
</article>