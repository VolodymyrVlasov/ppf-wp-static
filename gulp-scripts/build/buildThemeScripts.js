// import gulp from "gulp";
// import { deleteSync } from "del";

// const SRC_PATH = ["dev/wp-theme/js/**/*.js"];
// const TARGET_PATH = "dist/paperfox/js/";

// const buildThemeScripts = () => {
//   try {
//     deleteSync([TARGET_PATH + "**/*.js"]);
//     gulp.src(SRC_PATH, { aloowEmpty: true }).pipe(gulp.dest(TARGET_PATH));
//     return true;
//   } catch (error) {
//     console.error("---> buildThemeScripts interupted with error: " + error);
//     return false;
//   }
// };

// export { buildThemeScripts, SRC_PATH, TARGET_PATH };


// ./gulp-scripts/build/buildThemeScripts.js
import gulp from "gulp";
import { deleteSync } from "del";

const SRC_PATH = ["dev/wp-theme/js/**/*.js"];
const TARGET_PATH = "dist/paperfox/js/";

// утиліта: чекати завершення gulp stream
function waitForStream(stream) {
  return new Promise((resolve, reject) => {
    stream.once("finish", resolve).once("end", resolve).once("error", reject);
  });
}

const buildThemeScripts = async () => {
  try {
    // видалення старих js
    deleteSync([`${TARGET_PATH}**/*.js`], { force: true });

    // копіювання нових
    const stream = gulp
      .src(SRC_PATH, { allowEmpty: true }) // виправлено
      .pipe(gulp.dest(TARGET_PATH));

    await waitForStream(stream);
    return true;
  } catch (error) {
    console.error("---> buildThemeScripts interrupted with error:", error);
    throw error;
  }
};

export { buildThemeScripts, SRC_PATH, TARGET_PATH };
