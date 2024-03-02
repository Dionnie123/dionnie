<?php
get_header(); ?>
<main role="main">
    <div class="container my-5">
        <div class="row">

            <div class=" <?php echo is_active_sidebar('primary-sidebar') ?  'col-lg-9' : 'col-lg-12'   ?> ">
                <div class="card p-5">
                    <?php
                    while (have_posts()) :
                        the_post();
                    ?>
                        <?php get_template_part('template-parts/post/content'); ?>

                    <?php


                    endwhile; ?>
                </div>
            </div>

            <?php if (is_active_sidebar('primary-sidebar')) { ?>
                <div class="col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>