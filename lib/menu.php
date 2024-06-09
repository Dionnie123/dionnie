<?php

namespace _ThemeName;



class Menu
{

    public function __construct()
    {
    }

    public function init()
    {
        add_filter('wp_nav_menu_args', function ($args) {
            if (isset($args['walker']) && is_string($args['walker']) && class_exists($args['walker'])) {
                $args['walker'] = new $args['walker'];
            }
            return $args;
        }, 1001);
    }


    public function view()
    {
        if (has_nav_menu('main-menu')) {
            wp_nav_menu(array(
                'menu_class'     => 'c-navigation__main-menu',
                'theme_location' => 'main-menu',

            ));
        } else {
            echo 'No menu available';
        }
    }
}

(new \_ThemeName\Menu)->init();
