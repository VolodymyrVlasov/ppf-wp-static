import gulp from "gulp";
import replace from "gulp-replace";
import { wpVar } from "../../const.js";

const SRC_PATH = [
  "dev/pages/**/*.html",
  "dev/pages/.htaccess",
  "!dev/pages/test/**/*",
];
const TARGET_PATH = "dist/www/";

const buildPages = () => {
  let streamHtml = gulp.src(SRC_PATH, { aloowEmpty: true });

  streamHtml.pipe(fileInclude({ prefix: "@@", basepath: "@file" }));

  for (const [placeholder, value] of Object.entries(wpVar)) {
    streamHtml = streamHtml.pipe(replace(placeholder, value));
  }

  streamHtml.pipe(webpHtml()).pipe(gulp.dest(TARGET_PATH));
};

export default buildPages;
