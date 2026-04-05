// import gulp from "gulp";
// import webp from "gulp-webp";
// import { deleteSync } from "del";

// const SRC_PATH = ["dev/static/**/*"];
// const TARGET_PATH = "dist/paperfox/static/";
// const QUALITY_FACTOR = 90;

// const buildAssets = () => {
//   try {
//     deleteSync([TARGET_PATH + "**/*"]);
//     gulp
//       .src(SRC_PATH)
//       .pipe(gulp.dest(TARGET_PATH))
//       .pipe(webp({ quality: QUALITY_FACTOR }))
//       .pipe(gulp.dest(TARGET_PATH));

//     return true;
//   } catch (error) {
//     console.error("---> BuildAssets interupted. " + error);
//     return false;
//   }
// };

// export { buildAssets, SRC_PATH, TARGET_PATH };


// ./gulp-scripts/build/buildAssets.js
import gulp from "gulp";
import webp from "gulp-webp";
import { deleteSync } from "del";

const SRC_PATH = ["dev/static/**/*"];
const TARGET_PATH = "dist/paperfox/static/";
const QUALITY_FACTOR = 90;

// хелпер: дочекатися завершення gulp-стріму
function waitForStream(stream) {
  return new Promise((resolve, reject) => {
    stream.once("finish", resolve).once("end", resolve).once("error", reject);
  });
}

const buildAssets = async () => {
  try {
    // чистимо цільову папку перед збиранням
    deleteSync([`${TARGET_PATH}**/*`], { force: true });

    // 1) копія оригіналів
    // 2) конвертація у webp
    // 3) запис webp поряд з оригіналами
    const stream = gulp
      .src(SRC_PATH, { allowEmpty: true })
      .pipe(gulp.dest(TARGET_PATH))
      .pipe(webp({ quality: QUALITY_FACTOR }))
      .pipe(gulp.dest(TARGET_PATH));

    await waitForStream(stream);
    return true; // опційно: можна просто нічого не повертати, але true іноді зручно
  } catch (error) {
    console.error("---> BuildAssets interrupted. " + error);
    // кинемо помилку далі, щоб gulp отримав fail статус
    throw error;
  }
};

export { buildAssets, SRC_PATH, TARGET_PATH };
