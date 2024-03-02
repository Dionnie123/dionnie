import yargs from "yargs";
import cleanCss from "gulp-clean-css";
import gulpif from "gulp-if";
import postcss from "gulp-postcss";
import sourcemaps from "gulp-sourcemaps";
import autoprefixer from "autoprefixer";
import { src, dest, watch, series, parallel } from "gulp";
import imagemin from "gulp-imagemin";
import webpack from "webpack-stream";
import named from "vinyl-named";
import del from "del";
import browserSync from "browser-sync";
import zip from "gulp-zip";
import info from "./package.json";
import replace from "gulp-replace";
import rename from "gulp-rename";
import wpPot from "gulp-wp-pot";

const PRODUCTION = yargs.argv.prod;
const server = browserSync.create();
var sass = require("gulp-sass")(require("sass"));

var paths = {
  rename: {
    src: [
      "archive-_themename_portfolio.php",
      "single-_themename_portfolio.php",
      "taxonomy-_themename_skills.php",
      "taxonomy-_themename_project_type.php",
    ],
  },
  styles: {
    src: "src/assets/scss/**/*.scss",
    dest: "dist/assets/css",
  },
  scripts: {
    src: "src/assets/js/**/*.js",
    dest: "dist/assets/js",
  },
  images: {
    src: "src/assets/images/**/*.{jpg,jpeg,png,svg,gif}",
    dest: "dist/assets/images",
  },
  other: {
    src: "src/assets/**/*",
    dest: "dist/assets",
  },

  plugins: {
    src: [
      "../../plugins/_themename-metaboxes/packaged/*",
      "../../plugins/_themename-shortcodes/packaged/*",
      "../../plugins/_themename-post-types/packaged/*",
    ],
    dest: ["lib/plugins"],
  },

  package: {
    src: [
      "**/*",
      "!.vscode",
      "!node_modules{,/**}",
      "!packaged{,/**}",
      "!src{,/**}",
      "!.babelrc",
      "!.gitignore",
      "!gulpfile.babel.js",
      "!package.json",
      "!package-lock.json",
      "!archive-_themename_portfolio.php",
      "!single-_themename_portfolio.php",
      "!taxonomy-_themename_skills.php",
      "!taxonomy-_themename_project_type.php",
    ],
    dest: "packaged",
  },
};

export const pot = () => {
  return src("**/*.php")
    .pipe(
      wpPot({
        domain: "_themename",
        package: info.slug,
      })
    )
    .pipe(dest(`languages/${info.name}.pot`));
};

export const styles = () => {
  return src(paths.styles.src)
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(sass().on("error", sass.logError))
    .pipe(gulpif(PRODUCTION, postcss([autoprefixer])))
    .pipe(gulpif(PRODUCTION, cleanCss({ compatibility: "ie8" })))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(dest(paths.styles.dest))
    .pipe(server.stream());
};

export const scripts = () => {
  return src(paths.scripts.src)
    .pipe(named())
    .pipe(
      webpack({
        module: {
          rules: [
            {
              test: /\.js$/,
              use: {
                loader: "babel-loader",
                options: {
                  presets: ["@babel/preset-env"], //or ['babel-preset-env']
                },
              },
            },
          ],
        },
        mode: PRODUCTION ? "production" : "development",
        devtool: !PRODUCTION ? "inline-source-map" : false,
        output: {
          filename: "[name].js",
        },
        externals: {
          jquery: "jQuery",
        },
      })
    )
    .pipe(dest(paths.scripts.dest));
};

export const images = () => {
  return src(paths.images.src)
    .pipe(gulpif(PRODUCTION, imagemin()))
    .pipe(dest(paths.images.dest));
};

export const watchChanges = () => {
  watch("src/assets/scss/**/*.scss", styles);
  watch("src/assets/js/**/*.js", series(scripts, reload));
  watch("**/*.php", reload);
  watch(paths.images.src, series(images, reload));
  watch(paths.other.src, series(copy, reload));
};

export const copy = () => {
  return src(paths.other.src).pipe(dest(paths.other.dest));
};

export const copyPlugins = () => {
  return src(paths.plugins.src).pipe(dest(paths.plugins.dest));
};

export const clean = () => {
  return del(["dist", "bundled", "languages"]);
};

export const compress = () => {
  return src([
    "**/*",
    "!node_modules{,/**}",
    "!bundled{,/**}",
    "!src{,/**}",
    "!.babelrc",
    "!.gitignore",
    "!gulpfile.babel.js",
    "!package.json",
    "!package-lock.json",
  ])
    .pipe(replace("_themetitle", info.title))
    .pipe(replace("_themedescription", info.description))
    .pipe(replace("_themeauthor", info.author))
    .pipe(replace("_themename_", info.name + "_"))
    .pipe(replace("_themename-", info.slug + "-"))
    .pipe(replace("_themename", info.slug))
    .pipe(replace("_ThemeName", info.namespace))
    .pipe(zip(`${info.slug}.zip`))
    .pipe(dest(paths.package.dest));
};

export const replace_filenames = () => {
  return src(paths.rename.src)
    .pipe(
      rename((path) => {
        path.basename = path.basename.replace("_themename", info.name);
      })
    )
    .pipe(dest("./"));
};

export const delete_replaced_filenames = () => {
  return del(
    paths.rename.src.map((filename) =>
      filename.replace("_themename", info.name)
    )
  );
};

export const serve = (done) => {
  server.init({
    proxy: "http://provider.test/",
  });
  done();
};
export const reload = (done) => {
  server.reload();
  done();
};

export const dev = series(
  clean,
  parallel(styles, scripts, images, copy),
  serve,
  watchChanges
);
export const build = series(
  clean,
  parallel(styles, scripts, images, copy),
  copyPlugins,
  pot
);

export const bundle = series(
  build,
  //replace_filenames,
  compress
  //  delete_replaced_filenames
);

export default dev;
