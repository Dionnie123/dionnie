<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<header role="banner" class="p-3 bg-primary text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-between">


            <div>
                <a href="<?php echo esc_html(home_url('/')) ?>" class="">
                    <?php _themename_the_custom_logo() ?>

                </a>
            </div>




            <div class="">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">About</a></li>
                </ul>
            </div>






            <div class="text-end">

                <?php get_search_form(true) ?>
            </div>
        </div>
    </div>
</header>

<body id="content">