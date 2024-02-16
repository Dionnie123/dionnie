<?php
require_once(get_template_directory() . '/dist/lib/custom_menu_walker.php');
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<header role="banner" class=" bg-primary text-white">
    <div class="container p-3">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-between">

            <div class="text-center">
                <a href="<?php echo esc_html(home_url('/')) ?>" class="">
                    <?php _themename_the_custom_logo() ?>
                    <h6 class="m-2 c-header__blogname"> <?php echo get_bloginfo('name') ?></h6>
                </a>

            </div>

            <div class="c-navigation">
                <div class="container">
                    <nav class="header-nav primary-navigation" role="navigation" aria-label="<?php esc_html_e('Main Navigation', '_themename') ?>">
                        <?php



                        wp_nav_menu(array(
                            'menu_class'     => 'c-navigation__main-menu',
                            'theme_location' => 'main-menu',
                            'walker' => 'Custom_Menu_Walker'
                        )) ?>
                    </nav>
                </div>
            </div>

            <div class="text-end">
                <?php get_search_form(true) ?>
            </div>
        </div>
    </div>

</header>

<body id="content">