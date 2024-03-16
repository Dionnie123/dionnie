<a class="c-post__readmore btn btn-primary btn-sm" href="<?php esc_url(the_permalink());  ?> " title="<?php the_title_attribute(['echo' => false]) ?>">
    <span class="btn-label">
        <i class="fa fa-check"></i>
    </span>&nbsp;<?php

                    echo __('Read More', '_themename');

                    /* translators: %s: Post Title 
                    printf(
                        wp_kses(
                            __('Read More <span class="u-screen-reader-text">About %s</span>', '_themename'),
                            [
                                'span' => [
                                    'class' => []
                                ]
                            ]
                        ),
                        get_the_title()
                    );*/

                    ?> </a>