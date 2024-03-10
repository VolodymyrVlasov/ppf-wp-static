import gulp from "gulp";

const SRC_PATH = ["dev/wp-theme/js/**/*.js"];
const TARGET_PATH = "dist/paperfox/js/";

const buildThemeScripts = () => {
  gulp.src(SRC_PATH, { aloowEmpty: true }).pipe(gulp.dest(TARGET_PATH));
};

export { buildThemeScripts, SRC_PATH, TARGET_PATH };
