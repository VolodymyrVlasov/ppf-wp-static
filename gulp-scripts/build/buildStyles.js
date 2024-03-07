import gulp from "gulp";
import replace from "gulp-replace";
import { wpVar } from "../../const.js";

const SRC_PATH = ["dev/styles/**/*.css", "!dev/styles/style.css"];
const TARGET_PATH = "paperfox/styles";
const MAIN_STYLE_PATH = ["dev/styles/style.css"];
const MAIN_STYLE_TARGET_PATH = ["paperfox/"];

const buildStyles = () => {
  let streamCss = gulp.src(SRC_PATH, { aloowEmpty: true });

  for (const [placeholder, value] of Object.entries(wpVar)) {
    streamCss.pipe(replace(placeholder, value)).pipe(gulp.dest(TARGET_PATH));
  }

  let streamMainCss = gulp.src(MAIN_STYLE_PATH, { aloowEmpty: true });
  streamMainCss
    .pipe(replace("./_", "./styles/_"))
    .pipe(gulp.dest(MAIN_STYLE_TARGET_PATH));
};

export default buildStyles;
