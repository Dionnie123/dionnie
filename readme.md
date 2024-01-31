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
