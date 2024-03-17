import gulp from "gulp";
import { deleteSync } from "del";

const SRC_PATH = ["dev/src/**/*.js"];
const TARGET_PATH = "dist/src/";

const buildPagesScripts = () => {
  try {
    deleteSync([TARGET_PATH + "**/*.js"]);
    gulp.src(SRC_PATH, { aloowEmpty: true }).pipe(gulp.dest(TARGET_PATH));
    return true;
  } catch (error) {
    console.error("---> BuildPagesScripts interupted. " + error);
    return false;
  }
};

export { buildPagesScripts, SRC_PATH, TARGET_PATH };
