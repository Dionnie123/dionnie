<?php


class Custom_Menu_Walker extends Walker_Nav_Menu
{

    function start_lvl(&$output, $depth = 0, $args = null)
    {
        // Add custom class to the <ul> at this level
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"c-navigation__sub-menu sub-menu-level-$depth\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = \null, $id = 0)
    {
        // Add custom class to each <li> item
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

        $atts = array();
        $atts['title']  = !empty($item->title) ? esc_attr($item->title) : '';
        $atts['target'] = !empty($item->target) ? esc_attr($item->target) : '';
        $atts['rel']    = !empty($item->xfn) ? esc_attr($item->xfn) : '';
        $atts['href']   = !empty($item->url) ? esc_attr($item->url) : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

        // You can add more customizations or classes as needed
    }

    function end_lvl(&$output, $depth = 0, $args = null)
    {
        // Add custom closing tag for the <ul> at this level
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    // Add this method to fix the compatibility issue
    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        // Add custom closing tag for the <li> item
        $output .= "</li>\n";
    }
}


?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<header role="banner" class=" bg-primary text-white">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-center ">

            <div>
                <a href="<?php echo esc_html(home_url('/')) ?>" class="">
                    <?php _themename_the_custom_logo() ?>

                </a>
            </div>

            <div class="c-navigation">
                <div class="container">
                    <nav class="header-nav primary-navigation" role="navigation" aria-label="<?php esc_html_e('Main Navigation', '_themename') ?>">
                        <?php wp_nav_menu(array(
                            'menu_class'     => 'c-navigation__main-menu',
                            'theme_location' => 'main-menu', 'walker' => new Custom_Menu_Walker()
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