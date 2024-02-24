Resources:
https://devsnap.me/css-menu
https://generatewp.com/login/ mbulingit:Bcmnvxz,./123
https://www.wpbeginner.com/beginners-guide/6-cool-things-you-can-do-with-sticky-posts-in-wordpress/

NOTES:

Node.js has two module systems:

1. CommonJS modules - default
2. ES modules (ES5 2009 & ES6 2015) - search "Enable ES modules in node.js package"

Difference:

CommonJS:
var gulp = require("gulp")

ES:
import gulp from "gulp";

What's Babel?
We use Babel to make our website compatible with older browsers e.g IE6
Babel converts ES syntax to CommonJS
The caveat: Some latest packages are built in pure ES Modules which means babel cannot just simply convert them so you have to downgrade the package e.g "del": "^6.0.0" & "gulp-imagemin": "^7.1.0",

Wordpress Bug:

1. When creating a custom walker class on menu e.g header.php it will now show edit icon button
   Solution: add custom filter and Stringify class call

https://wordpress.stackexchange.com/a/295475
https://wordpress.stackexchange.com/questions/281854/visible-edit-shortcut-for-wordpress-menu-that-uses-nav-walker

WORDPRESS CONCEPTS

ACCESSIBLE GLOBAL FUNCTIONS
Want a Class or Function accessible globally without import? add it functions.php

CUSTOMIZER API:
Setting Types

1. Refresh - refreshes the whole iframe
2. postMessage - refreshes element with specified selector e.g id,classname, pros: realtime-edit, refreshes only specific elementor with selector,
   cons: every update calls ajax, you have to replicated php logic to javascript logic
3. selective-referesh - refreshes element with specified selector, pros: refreshes only specific elementor with selector, waits for editing to finish before calling ajax request no need to replicated php logic to javascript logic
   Note: on selective refresh, if no selector specified the whole iframe will be refreshed

CUSTOM FIELDS

Meta Data consists of:
Meta Key
Meta Value
contained inside:
Meta Box which can be added via:
Custom fields

get_post_meta(get_the_ID(), 'Price', true)

https://stackoverflow.com/questions/64390664/how-to-implement-switchable-themes-in-scss
