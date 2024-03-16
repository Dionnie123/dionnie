<?php

get_template_part('template-parts/filter');
$query = (new \_ThemeName\PostService)->getAll();
?>
<?php


// Check if the session variable is set
if (get_transient('post_deleted')) {

    // Display the notification
?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php

    // Unset the session variable to prevent the notification from showing again on subsequent page loads

    delete_transient('post_deleted');
}
?>

<?php if ($query->have_posts()) : ?>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-1 gx-3 gy-3">
    <?php while ($query->have_posts()) : $query->the_post(); ?>
    <?php get_template_part('template-parts/post/item'); ?>
    <?php endwhile; ?>
</div>
<?php bootstrap_pagination($query) ?>
<?php else : ?>
<div class="container no-posts">
    <h3><?php _e(apply_filters('_themename_no_posts_text',   esc_html("No Posts Found")), '_themename')  ?>
    </h3>
</div>
<?php endif; ?>





<?php wp_reset_postdata(); ?>