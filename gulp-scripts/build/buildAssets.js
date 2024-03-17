import gulp from "gulp";
import webp from "gulp-webp";
import { deleteSync } from "del";

const SRC_PATH = ["dev/static/**/*"];
const TARGET_PATH = "dist/paperfox/static/";
const QUALITY_FACTOR = 80;

const buildAssets = () => {
  try {
    deleteSync([TARGET_PATH + "**/*"]);
    gulp
      .src(SRC_PATH)
      .pipe(gulp.dest(TARGET_PATH))
      .pipe(webp({ quality: QUALITY_FACTOR }))
      .pipe(gulp.dest(TARGET_PATH));

    return true;
  } catch (error) {
    console.error("---> BuildAssets interupted. " + error);
    return false;
  }
};

export { buildAssets, SRC_PATH, TARGET_PATH };
