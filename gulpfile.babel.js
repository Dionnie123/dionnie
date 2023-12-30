import sass from "gulp-sass";
import browserSync from "browser-sync";
import useref from "gulp-useref";
import uglify from "gulp-uglify";
import gulpIf from "gulp-if";
import cssnano from "gulp-cssnano";
import gulp from "gulp";

//Say Hello
gulp.task("hello", async function () {
  console.log("Hello Zell");
});

//Convert a sass file into a css file
gulp.task("sass-one", function () {
  return gulp
    .src("src/scss/styles.scss")
    .pipe(sass()) // Converts Sass to CSS with gulp-sass
    .pipe(gulp.dest("src/css"));
});

//Convert multiple sass files using pattern matching
gulp.task("sass-all", function () {
  return gulp
    .src("src/scss/**/*.scss")
    .pipe(sass()) // Converts Sass to CSS with gulp-sass
    .pipe(gulp.dest("src/css"))
    .pipe(
      browserSync.reload({
        stream: true,
      })
    );
});

gulp.task("optimize", function () {
  return gulp
    .src("src/*.html")
    .pipe(useref())
    .pipe(gulpIf("*.js", uglify()))
    .pipe(gulpIf("*.css", cssnano()))
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
    server: "./src",
  });
  gulp.watch("src/scss/**/*.scss", gulp.series("sass-all"));
  gulp.watch("src/*.html", gulp.series("optimize"));
  gulp.watch("src/js/**/*.js", gulp.series("optimize"));
});
