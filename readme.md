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
