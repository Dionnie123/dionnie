import { src, dest } from "gulp";
import yargs from "yargs";
import cleanCss from "gulp-clean-css";
import gulpif from "gulp-if";
import postcss from "gulp-postcss";
import sourcemaps from "gulp-sourcemaps";
import autoprefixer from "autoprefixer";
import { src, dest, watch } from "gulp";
const PRODUCTION = yargs.argv.prod;

var sass = require("gulp-sass")(require("sass"));

var paths = {
  root: "./src",
  html: {
    src: "src/*.html",
  },
  styles: {
    src: "src/scss/**/*.scss",
    dest: "src/css",
  },
  scripts: {
    src: "src/js/**/*.js",
    dest: "src/js",
  },
};

export const styles = () => {
  return src(paths.styles.src, "src/scss/admin.scss")
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(sass().on("error", sass.logError))
    .pipe(gulpif(PRODUCTION, postcss([autoprefixer])))
    .pipe(gulpif(PRODUCTION, cleanCss({ compatibility: "ie8" })))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(dest("dist/css"));
};

export const watchForChanges = () => {
  watch("src/scss/**/*.scss", styles);
};
