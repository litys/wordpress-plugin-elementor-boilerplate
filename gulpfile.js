const gulp = require("gulp");
const ts = require("gulp-typescript");
const sass = require("gulp-sass")(require("sass"));
const cleanCSS = require("gulp-clean-css");
const uglify = require("gulp-uglify");
const concat = require("gulp-concat");
const stripComments = require("gulp-strip-comments");
const browserSync = require("browser-sync").create();
const tsProject = ts.createProject("tsconfig.json");

const paths = {
  styles: {
    src: "src/styles/**/*.scss",
    dest: "dist/css",
  },
  scripts: {
    src: "src/scripts/**/*.ts",
    srcjs: "src/scripts/**/*.js",
    dest: "dist/js",
  },
  php: {
    src: "**/*.php",
  },
};

function styles() {
  return gulp
    .src(paths.styles.src)
    .pipe(sass().on("error", sass.logError))
    .pipe(cleanCSS({ level: 2 }))
    .pipe(gulp.dest(paths.styles.dest))
    .pipe(browserSync.stream());
}

function scripts() {
  return tsProject
    .src()
    .pipe(tsProject())
    .js.pipe(stripComments())
    .pipe(concat("main.js"))
    .pipe(uglify())
    .pipe(gulp.dest(paths.scripts.dest))
    .pipe(browserSync.stream());
}

function serve() {
  browserSync.init({
    proxy: "http://elementor-demo.local",
    open: true,
  });

  gulp.watch(paths.styles.src, styles);
  gulp.watch(paths.scripts.src, scripts);
  gulp.watch(paths.scripts.srcjs, scripts);
  gulp.watch(paths.php.src).on("change", browserSync.reload);
}

exports.styles = styles;
exports.scripts = scripts;
exports.serve = serve;
exports.default = gulp.series(styles, scripts, serve);
