// import gulp from "gulp";
// import replace from "gulp-replace";
// import fileInclude from "gulp-file-include";
// import webpHtml from "gulp-webp-html-nosvg";
// import { deleteSync } from "del";

// const SRC_PATH = [
//   "dev/pages/**/*.html",
//   "dev/pages/.htaccess",
//   "!dev/pages/test/**/*",
//   "!dev/pages/index.html",
//   "!dev/pages/404.html",
// ];
// const TARGET_PATH = "dist/www/";

// const buildPages = (vars) => {
//   try {
//     deleteSync([TARGET_PATH + "**/*.html"]);
//     let streamHtml = gulp.src(SRC_PATH, { aloowEmpty: true });
//     streamHtml.pipe(fileInclude({ prefix: "@@", basepath: "@file" }));

//     for (const [placeholder, value] of Object.entries(vars)) {
//       streamHtml = streamHtml.pipe(replace(placeholder, value));
//     }

//     streamHtml.pipe(webpHtml()).pipe(gulp.dest(TARGET_PATH));
//     return true;
//   } catch (error) {
//     console.error("---> buildPages interupted with error: " + error);
//     return false;
//   }
// };

// export { buildPages, SRC_PATH, TARGET_PATH };


// ./gulp-scripts/build/buldPages.js
import gulp from "gulp";
import replace from "gulp-replace";
import fileInclude from "gulp-file-include";
import webpHtml from "gulp-webp-html-nosvg";
import { deleteSync } from "del";

const SRC_HTML = [
  "dev/pages/**/*.html",
  "!dev/pages/test/**/*",
  "!dev/pages/index.html",
  "dev/pages/404.html",
];
const SRC_DOTFILES = ["dev/pages/.htaccess"];
const TARGET_PATH = "dist/www/";

// утиліта: дочекатися завершення gulp-стріму
function waitForStream(stream) {
  return new Promise((resolve, reject) => {
    stream.once("finish", resolve).once("end", resolve).once("error", reject);
  });
}

const buildPages = async (vars = {}) => {
  try {
    // чистимо старі HTML (не чіпаємо інші файли, зокрема .htaccess)
    deleteSync([`${TARGET_PATH}**/*.html`], { force: true });

    // 1) HTML: include -> vars replace -> webpHtml -> dest
    let htmlStream = gulp.src(SRC_HTML, { allowEmpty: true });
    htmlStream = htmlStream.pipe(fileInclude({ prefix: "@@", basepath: "@file" }));
    for (const [placeholder, value] of Object.entries(vars)) {
      htmlStream = htmlStream.pipe(replace(placeholder, value));
    }
    htmlStream = htmlStream.pipe(webpHtml()).pipe(gulp.dest(TARGET_PATH));

    // 2) .htaccess: просто копіюємо як є
    const dotStream = gulp
      .src(SRC_DOTFILES, { allowEmpty: true })
      .pipe(gulp.dest(TARGET_PATH));

    await Promise.all([waitForStream(htmlStream), waitForStream(dotStream)]);
    return true;
  } catch (error) {
    console.error("---> buildPages interrupted with error:", error);
    throw error;
  }
};

const SRC_WATCH = [
  ...SRC_HTML,
  "dev/pages/.htaccess", // <-- відслідковуємо зміни .htaccess
];

export { buildPages, SRC_WATCH as SRC_PATH, TARGET_PATH };