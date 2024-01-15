<?php

get_header();
?>
<div class="container">
    <header>
        <?php the_archive_title('<h1>', '</h1>') ?>
        <?php the_archive_description('<p>', '</p>') ?>
    </header>
</div>
<?php
get_template_part('template-parts/post/loop');
get_footer();
