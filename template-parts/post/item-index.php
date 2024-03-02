<article <?php post_class('c-post col') ?>>
    <div class="card h-100">

        <div class="card-body">
            <h5 class="card-title"><?php esc_html(the_title()); ?></h5>
            <p class="card-text">
                <?php echo wp_kses_post(wp_trim_words(get_the_excerpt(), 15)); // Limit excerpt to 15 words 
                ?>
            </p>


            <button type="button" class="btn btn-sm btn-primary position-relative">
                Comments
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?php echo countable_text('1', '%s', get_comments_number()); ?>
                    <span class="visually-hidden">comments</span>
                </span>
            </button>

            <?php get_template_part('template-parts/post/button-readmore',) ?>
            <?php get_template_part('template-parts/post/button-delete',) ?>

            <?php echo do_shortcode('[current_year]'); ?>
            <i class="bi bi-0-circle"></i>
            <i class="bi-alarm" style="font-size: 2rem; color: cornflowerblue;"></i>
            <i class="bi bi-plus-square-fill" style="font-size: 2rem; color: cornflowerblue;"></i>
            <table class="table table-sm  table-striped table-hover table-bordered rounded-1 overflow-hidden fs-6"
                style="font-size: 14px !important;">

                <tbody>
                    <tr>

                        <th>Price</th>
                        <td><?php echo (new \_ThemeName\Post)->get_layout()  ?></td>

                    </tr>
                    <tr>

                        <th>Note</th>
                        <td><?php echo sanitize_text_field(get_post_meta(get_the_ID(), 'Note', true))  ?>
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</article>