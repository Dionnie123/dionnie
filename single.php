<?php

$layout = _themename_meta(get_the_ID(), '_themename_post_layout', 'sidebar');
$sidebar = is_active_sidebar('primary-sidebar');
if ($layout === 'sidebar' && !$sidebar) {
    $layout = 'full';
}



get_header(); ?>
<main role="main">
    <div class=" container-lg my-4">
        <div class="row d-flex justify-content-center g-3">

            <div class="col-2"></div>

            <div class="  <?php echo $layout == 'sidebar' ?  'col-lg-6' : 'col-lg-12'   ?> ">

                <?php
                while (have_posts()) :
                    the_post();
                ?>
                    <?php get_template_part('template-parts/single/content'); ?>

                    <?php get_template_part('template-parts/single/author') ?>

                    <?php get_template_part('template-parts/single/navigation') ?>

                <?php endwhile; ?>

            </div>

            <?php if ($layout === 'sidebar') { ?>
                <div class="col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>