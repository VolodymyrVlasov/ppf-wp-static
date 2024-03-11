import gulp from "gulp";

const SRC_PATH = ["dev/wp-theme/js/**/*.js"];
const TARGET_PATH = "dist/paperfox/js/";

const buildThemeScripts = () => {
  try {
    gulp.src(SRC_PATH, { aloowEmpty: true }).pipe(gulp.dest(TARGET_PATH));
    return true;
  } catch (error) {
    console.error("---> buildThemeScripts interupted with error: " + error);
    return false;
  }
};

export { buildThemeScripts, SRC_PATH, TARGET_PATH };
