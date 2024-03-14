<?php

get_header();

?>
<div class="container">
    <div class="card p-3 mt-5">
        <figure class="mb-0">
            <blockquote class="blockquote">
                <p>A well-known quote, contained in a blockquote element.</p>
            </blockquote>
            <figcaption class="blockquote-footer">
                Someone famous in <cite title="Source Title">Source Title</cite>
            </figcaption>
        </figure>
    </div>
</div>
<?php

get_template_part('template-parts/post/loop');

get_footer();
