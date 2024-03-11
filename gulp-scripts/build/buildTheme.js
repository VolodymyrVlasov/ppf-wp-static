import gulp from "gulp";
import replace from "gulp-replace";
import fileInclude from "gulp-file-include";
import webpHtml from "gulp-webp-html-nosvg";

import { wpVar } from "../../const.js";

const SRC_PATH = [
  "dev/wp-theme/**/*.php",
  "!dev/wp-theme/woocommerce/disable-checkout.php",
];
const TARGET_PATH = "dist/paperfox/";

const buildTheme = () => {
  try {
    let streamPhp = gulp.src(SRC_PATH, { aloowEmpty: true });
    streamPhp
      .pipe(fileInclude({ prefix: "@@", basepath: "@file" }))
      .pipe(gulp.dest(TARGET_PATH));

    for (const [placeholder, value] of Object.entries(wpVar)) {
      streamPhp = streamPhp.pipe(replace(placeholder, value));
    }
    streamPhp
      .pipe(webpHtml())
      .pipe(
        replace(
          'src="./static',
          'src="<?php echo get_template_directory_uri();?>/static'
        )
      )
      .pipe(gulp.dest(TARGET_PATH));
    return true;
  } catch (error) {
    console.error("---> buildPages interupted with error: " + error);
    return false;
  }
};

export { buildTheme, SRC_PATH, TARGET_PATH };
