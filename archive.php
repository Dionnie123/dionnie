<?php

$layout = _themename_meta( get_the_ID(), '_themename_post_layout', 'full' );
$sidebar = is_active_sidebar( 'primary-sidebar' );
if($layout === 'sidebar' && !$sidebar) {
    $layout = 'full';
}


get_header();

?>



<main role="main">
    <div class="container">
        <div class="row">



            <div class=" <?php $layout == 'sidebar' ?  'col-lg-9' : 'col-lg-12'   ?> ">


                <div class="c-archive-page-header">
                    <header>
                        <div class="card p-3 d-flex justify-content-center">
                            <?php the_archive_title('<h2>', '</h2>') ?>
                            <?php the_archive_description() ?>
                        </div>
                    </header>
                </div>


                <?php get_template_part('template-parts/loops/loop-archive'); ?>
            </div>
            <?php if( $layout === 'sidebar') { ?>
            <div class="col-lg-3">
                <?php get_sidebar(); ?>
            </div>
            <?php } ?>
        </div>
    </div>
</main>


<?php






get_footer();