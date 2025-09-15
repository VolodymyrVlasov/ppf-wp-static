// import gulp from "gulp";
// import replace from "gulp-replace";
// import fileInclude from "gulp-file-include";
// import webpHtml from "gulp-webp-html-nosvg";
// import { deleteSync } from "del";

// const SRC_PATH = [
//   "dev/wp-theme/**/*.php",
//   "dev/wp-theme/screenshot.png",
//   "!dev/wp-theme/woocommerce/disable-checkout.php",
// ];
// const TARGET_PATH = "dist/paperfox/";

// const buildTheme = (vars) => {
//   try {
//     deleteSync([TARGET_PATH + "**/*.php"]);
//     let streamPhp = gulp.src(SRC_PATH, { aloowEmpty: true });
//     streamPhp
//       .pipe(fileInclude({ prefix: "@@", basepath: "@file" }))
//       .pipe(gulp.dest(TARGET_PATH));

//     for (const [placeholder, value] of Object.entries(vars)) {
//       streamPhp = streamPhp.pipe(replace(placeholder, value));
//     }
//     streamPhp
//       .pipe(webpHtml())
//       .pipe(
//         replace(
//           'src="./static',
//           'src="<?php echo get_template_directory_uri();?>/static'
//         )
//       )
//       .pipe(gulp.dest(TARGET_PATH));
//     return true;
//   } catch (error) {
//     console.error("---> buildTheme interupted. " + error);
//     return false;
//   }
// };

// export { buildTheme, SRC_PATH, TARGET_PATH };


// ./gulp-scripts/build/buildTheme.js
import gulp from "gulp";
import replace from "gulp-replace";
import fileInclude from "gulp-file-include";
import webpHtml from "gulp-webp-html-nosvg";
import { deleteSync } from "del";

const SRC_PATH = [
  "dev/wp-theme/**/*.php",
  "dev/wp-theme/screenshot.png",
  "!dev/wp-theme/woocommerce/disable-checkout.php",
];
const TARGET_PATH = "dist/paperfox/";

// утиліта: дочекатися завершення gulp-стріму
function waitForStream(stream) {
  return new Promise((resolve, reject) => {
    stream.once("finish", resolve).once("end", resolve).once("error", reject);
  });
}

const buildTheme = async (vars = {}) => {
  try {
    // чистимо старі PHP перед збіркою (скрін не чіпаємо)
    deleteSync([`${TARGET_PATH}**/*.php`], { force: true });

    // єдиний стрім: include -> заміни -> webpHtml -> заміна src -> dest
    let stream = gulp.src(SRC_PATH, { allowEmpty: true });

    // підключення інклюдів у PHP
    stream = stream.pipe(fileInclude({ prefix: "@@", basepath: "@file" }));

    // заміни плейсхолдерів з vars
    for (const [placeholder, value] of Object.entries(vars)) {
      stream = stream.pipe(replace(placeholder, value));
    }

    // конвертація <img> у webp (nosvg) + підміна шляху до /static на WP-шаблонний
    stream = stream
      .pipe(webpHtml())
      .pipe(
        replace(
          'src="./static',
          'src="<?php echo get_template_directory_uri();?>/static'
        )
      )
      .pipe(gulp.dest(TARGET_PATH));

    await waitForStream(stream);
    return true;
  } catch (error) {
    console.error("---> BuildTheme interrupted.", error);
    throw error;
  }
};

export { buildTheme, SRC_PATH, TARGET_PATH };
