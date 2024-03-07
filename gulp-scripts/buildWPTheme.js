import buildStyles from "./build/buildStyles.js"

const SRC_PATH = "dev/wp-theme/";
const TARGET_PATH = "paperfox/";

export const buildWPTheme = (done) => {
  gulp.src(`${SRC_PATH}/screenshot.png`).pipe(gulp.dest(TARGET_PATH));

  // BUILD PHP
  let streamPhp = gulp.src(
    [`${SRC_PATH}**/*.php`, "!dev/wp-theme/woocommerce/disable-checkout.php"],
    { aloowEmpty: true }
  );

  streamPhp
    .pipe(fileInclude({ prefix: "@@", basepath: "@file" }))
    .pipe(gulp.dest("paperfox/"));

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
    .pipe(gulp.dest("paperfox/"));

    buildStyles();

  // gulp.src(["dev/styles/**/*.css"], { aloowEmpty: true })
  // .pipe(concat('style.css'))

  // BUILD STATIC CONTENT
  gulp
    .src("dev/static/**/*")
    .pipe(webp({ quality: 80 }))
    .pipe(gulp.dest("paperfox/static/"));

  gulp.src("dev/wp-theme/js/**/*").pipe(gulp.dest("paperfox/js/"));

  return done();
};
