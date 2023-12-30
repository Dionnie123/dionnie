import gulp from "gulp";

import browserSync from "browser-sync";
import useref from "gulp-useref";
import uglify from "gulp-uglify";
import gulpIf from "gulp-if";
import cssnano from "gulp-cssnano";

import es from "event-stream";
import concat from "gulp-concat";
import gutil from "gutil";
import autoprefixer from "autoprefixer";
import postcss from "gulp-postcss";
import postnested from "postcss-nested";

import sourcemaps from "gulp-sourcemaps";

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

gulp.task("styles", function () {
  var appFiles = gulp
    .src(paths.styles.src)
    .pipe(sourcemaps.init({ loadMaps: true }))
    .pipe(sass({ style: "compressed" }).on("error", gutil.log));

  return es
    .concat(appFiles)
    .pipe(concat("bundle.min.css"))
    .pipe(gulpIf("*.css", cssnano()))
    .pipe(postcss([autoprefixer()]))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest("dist/css/"))
    .pipe(
      browserSync.reload({
        stream: true,
      })
    );
});

gulp.task("js", function () {
  var appFiles = gulp.src(paths.scripts.src);

  return es
    .concat(appFiles)
    .pipe(concat("bundle.min.js"))
    .pipe(gulpIf("*.js", uglify()))
    .pipe(gulp.dest("dist/js/"))
    .pipe(
      browserSync.reload({
        stream: true,
      })
    );
});

gulp.task("optimize", function () {
  return gulp
    .src(paths.html.src)
    .pipe(sourcemaps.init({ loadMaps: true }))
    .pipe(useref())
    .pipe(gulpIf("*.js", uglify()))
    .pipe(gulpIf("*.css", cssnano()))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest("dist"))
    .pipe(
      browserSync.reload({
        stream: true,
      })
    );
});

//Watch out for changes
gulp.task("watch", function () {
  browserSync.create();
  browserSync.init({
    server: paths.root,
  });
  gulp.watch(paths.styles.src, gulp.series("styles"));
  gulp.watch(paths.html.src, gulp.series("optimize"));
  gulp.watch(paths.scripts.src, gulp.series("optimize"));
});
