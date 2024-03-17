import gulp from "gulp";
import replace from "gulp-replace";
import fileInclude from "gulp-file-include";
import webpHtml from "gulp-webp-html-nosvg";
import { wpVar } from "../../const.js";
import { deleteSync } from "del";

const SRC_PATH = [
  "dev/pages/**/*.html",
  "dev/pages/.htaccess",
  "!dev/pages/test/**/*",
  "!dev/pages/index.html",
  "!dev/pages/404.html",
];
const TARGET_PATH = "dist/www/";

const buildPages = () => {
  try {
    deleteSync([TARGET_PATH + "**/*.html"]);
    let streamHtml = gulp.src(SRC_PATH, { aloowEmpty: true });
    streamHtml.pipe(fileInclude({ prefix: "@@", basepath: "@file" }));

    for (const [placeholder, value] of Object.entries(wpVar)) {
      streamHtml = streamHtml.pipe(replace(placeholder, value));
    }

    streamHtml.pipe(webpHtml()).pipe(gulp.dest(TARGET_PATH));
    return true;
  } catch (error) {
    console.error("---> buildPages interupted with error: " + error);
    return false;
  }
};

export { buildPages, SRC_PATH, TARGET_PATH };
