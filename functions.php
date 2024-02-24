<?php
require_once(get_template_directory() . '/dist/lib/customize.php');
require_once(get_template_directory() . '/dist/lib/helpers.php');
require_once(get_template_directory() . '/dist/lib/theme-support.php');
require_once(get_template_directory() . '/dist/lib/enqueue-assets.php');
require_once(get_template_directory() . '/dist/lib/sidebars.php');
require_once(get_template_directory() . '/4-hooks-and-filters.php');
require_once(get_template_directory() . '/dist/lib/navigation.php');


require_once(get_template_directory() . '/dist/lib/services/post_service.php');


require_once(get_template_directory() . '/dist/lib/custom_post_types/books.php');

(new \_ThemeName\Book);
(new \_ThemeName\PostService)->registerActions();
