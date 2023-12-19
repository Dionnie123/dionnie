<div class="col">
    <div class="card  h-100">
        <?php
                        if (has_post_thumbnail()) {
                        ?>
        <img style="height:50%;max-height:50%;" src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top"
            alt="/app/images/post-placeholder.webp">
        <?php
                        } else {
                            // Display a placeholder image if no thumbnail is available
                        ?>
        <img style="height:50%;max-height:250px;"
            src="<?php echo get_template_directory_uri() . '/app/images/post-placeholder.webp'; ?>"
            class="card-img-top mh-50" alt="Placeholder Image">
        <?php
                        }
                        ?>
        <div class="card-body">
            <h5 class="card-title"><?php the_title(); ?></h5>

            <p class="card-text">
                <?php echo wp_trim_words(get_the_excerpt(), 20); // Limit excerpt to 20 words 
                                ?></p>
            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
        </div>
    </div>

</div>