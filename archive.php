<?php

get_header();
?>
<header>
    <?php the_archive_title('<h1>','</h1>') ?>
    <?php the_archive_description('<p>','</p>') ?>
</header>
<?php
get_template_part('posts-template');
//get_template_part('1-loops');
get_footer();