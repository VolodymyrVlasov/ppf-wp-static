import gulp from "gulp";

const SRC_PATH = ["dev/src/**/*.js"];
const TARGET_PATH = "dist/src/";

const buildPagesScripts = () => {
  try {
    gulp.src(SRC_PATH, { aloowEmpty: true }).pipe(gulp.dest(TARGET_PATH));
    return true;
  } catch (error) {
    console.error("---> BuildPagesScripts interupted. " + error);
    return false;
  }
};

export { buildPagesScripts, SRC_PATH, TARGET_PATH };
