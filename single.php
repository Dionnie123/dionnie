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
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                                <div class="entry-meta">
                                    <?php

                                    ?>
                                </div>
                            </header>

                            <div class="entry-content">
                                <?php
                                the_content();

                                wp_link_pages(
                                    array(
                                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'Your_Theme'),
                                        'after'  => '</div>',
                                    )
                                );
                                ?>
                            </div>

                            <footer class="entry-footer">

                            </footer><!-- .entry-footer -->
                        </article><!-- #post-<?php the_ID(); ?> -->

                    <?php
                        // If comments are open or we have at least one comment, load comments template.
                        if (comments_open() || get_comments_number()) {
                            comments_template();
                        }

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