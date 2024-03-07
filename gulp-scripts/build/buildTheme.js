import gulp from "gulp";
import replace from "gulp-replace";
import { wpVar } from "../../const.js";

const SRC_PATH = [
  "dev/wp-theme/**/*.php",
  "!dev/wp-theme/woocommerce/disable-checkout.php",
];
const TARGET_PATH = "paperfox/";

const buildTheme = () => {
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
};

export default buildTheme;
