import gulp from "gulp";
import replace from "gulp-replace";
import { wpVar } from "../../const.js";
import { deleteSync } from "del";

const SRC_PATH = ["dev/styles/**/*.css", "!dev/styles/style.css"];
const TARGET_PATH = "dist/paperfox/styles";
const MAIN_STYLE_PATH = ["dev/styles/style.css"];
const MAIN_STYLE_TARGET_PATH = ["dist/paperfox/"];

const buildStyles = () => {
  try {
    deleteSync([TARGET_PATH + "**/*.css"]);
    let streamCss = gulp.src(SRC_PATH[0], { aloowEmpty: true });

    for (const [placeholder, value] of Object.entries(wpVar)) {
      streamCss.pipe(replace(placeholder, value));
    }
    streamCss.pipe(gulp.dest(TARGET_PATH));

    let streamMainCss = gulp.src(MAIN_STYLE_PATH, { aloowEmpty: true });
    streamMainCss
      .pipe(replace("./_", "./styles/_"))
      .pipe(gulp.dest(MAIN_STYLE_TARGET_PATH));
    return true;
  } catch (error) {
    console.error("---> buildStyles interupted with error: " + error);
    return false;
  }
};

export { buildStyles, SRC_PATH, TARGET_PATH, MAIN_STYLE_PATH };
