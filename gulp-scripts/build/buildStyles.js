import gulp from "gulp";
import replace from "gulp-replace";
import { wpVar } from "../../const.js";
import { deleteSync } from "del";

const SRC_PATH = "dev/styles/";
const TARGET_PATH = "dist/paperfox/";

const buildStyles = () => {
  try {
    deleteSync(TARGET_PATH + "**/*.css");
    let streamCss = gulp.src(SRC_PATH + "**/*.css", {
      base: SRC_PATH,
      alowEmpty: true,
    });

    for (const [placeholder, value] of Object.entries(wpVar)) {
      streamCss = streamCss.pipe(replace(placeholder, value));
    }

    streamCss.pipe(gulp.dest(TARGET_PATH));
    return true;
  } catch (error) {
    return false;
  }
};

export { buildStyles, SRC_PATH, TARGET_PATH };
