// // ./gulp-scripts/build/buildStyles.js
// import gulp from "gulp";
// import replace from "gulp-replace";
// import { deleteSync } from "del";

// const SRC_PATH = "dev/styles/";
// const TARGET_PATH = "dist/paperfox/";

// // утиліта: чекати завершення gulp stream
// function waitForStream(stream) {
//   return new Promise((resolve, reject) => {
//     stream.once("finish", resolve).once("end", resolve).once("error", reject);
//   });
// }

// const buildStyles = async (vars = {}) => {
//   try {
//     // чистимо css перед збіркою
//     deleteSync([`${TARGET_PATH}**/*.css`], { force: true });

//     // беремо всі css з dev/styles
//     let streamCss = gulp.src(`${SRC_PATH}**/*.css`, {
//       base: SRC_PATH,
//       allowEmpty: true, // виправив
//     });

//     // замінюємо плейсхолдери
//     for (const [placeholder, value] of Object.entries(vars)) {
//       streamCss = streamCss.pipe(replace(placeholder, value));
//     }

//     // кладемо в dist/paperfox
//     streamCss = streamCss.pipe(gulp.dest(TARGET_PATH));

//     await waitForStream(streamCss);
//     return true;
//   } catch (error) {
//     console.error("---> BuildStyles interrupted.", error);
//     throw error;
//   }
// };

// export { buildStyles, SRC_PATH, TARGET_PATH };

// ./gulp-scripts/build/buildStyles.js
import gulp from "gulp";
import replace from "gulp-replace";
import { deleteSync } from "del";
import concat from "gulp-concat";
import dotenv from "dotenv";
import fs from "fs";
import path from "path";
import through2 from "through2";
import merge2 from "merge2";

dotenv.config();

const SRC_PATH = "dev/styles/";
const TARGET_PATH = "dist/paperfox/";

const PRIORITY = [
  "styles/_1_wp-theme.css",
  "styles/_typography.css",
  "styles/_variables.css",
  "styles/_theme.css",
];

const IS_CONCAT_CSS = String(process.env.IS_CONCAT_CSS || "")
  .trim()
  .toLowerCase() === "true";

function waitForStream(stream) {
  return new Promise((resolve, reject) => {
    stream.once("finish", resolve).once("end", resolve).once("error", reject);
  });
}

// нормалізація: прибираємо BOM та дублікати @charset
function normalizeCss() {
  return through2.obj(function (file, _, cb) {
    if (file.isBuffer()) {
      let css = file.contents.toString();
      css = css.replace(/^\uFEFF/, "");
      css = css.replace(/^\s*@charset\s+["'][^"']+["'];\s*/gim, "");
      file.contents = Buffer.from(css);
    }
    cb(null, file);
  });
}

const buildStyles = async (vars = {}) => {
  try {
    // 1) чистимо таргет
    deleteSync([`${TARGET_PATH}**/*.css`], { force: true });

    if (!IS_CONCAT_CSS) {
      // 2) без конкатенації — просто копіюємо як є
      let stream = gulp.src(`${SRC_PATH}**/*.css`, { base: SRC_PATH, allowEmpty: true });
      for (const [ph, val] of Object.entries(vars)) stream = stream.pipe(replace(ph, val));
      stream = stream.pipe(gulp.dest(TARGET_PATH));
      await waitForStream(stream);
      console.log("✅ Styles built (non-combined)");
      return true;
    }

    // 3) формуємо окремий потік для пріоритетних файлів у фіксованому порядку
    const priorityPaths = PRIORITY
      .map(rel => path.join(SRC_PATH, rel))
      .filter(p => {
        if (!fs.existsSync(p)) {
          console.warn(`⚠️  Пріоритетний файл не знайдено: ${p}`);
          return false;
        }
        return true;
      });

    const priorityStream = gulp
      .src(priorityPaths, { allowEmpty: true })
      .pipe(normalizeCss());

    // 4) решта файлів — окремий потік (виключаємо style.css з імпортами та пріоритети)
    const restExcludes = [
      `${SRC_PATH}style.css`,
      ...PRIORITY.map(rel => path.join(SRC_PATH, rel)),
    ];
    const restGlobs = [`${SRC_PATH}**/*.css`, ...restExcludes.map(p => `!${p}`)];

    const restStream = gulp
      .src(restGlobs, { allowEmpty: true })
      .pipe(normalizeCss());

    // 5) підстановка плейсхолдерів (на обидва стріми)
    let pStream = priorityStream;
    let rStream = restStream;
    for (const [ph, val] of Object.entries(vars)) {
      pStream = pStream.pipe(replace(ph, val));
      rStream = rStream.pipe(replace(ph, val));
    }

    // 6) зливаємо у правильному порядку → конкат у style.css
    let streamCss = merge2(pStream, rStream)
      .pipe(concat("style.css"))
      .pipe(gulp.dest(TARGET_PATH));

    await waitForStream(streamCss);
    console.log("✅ Styles built (combined -> style.css)");
    return true;
  } catch (error) {
    console.error("---> BuildStyles interrupted.", error);
    throw error;
  }
};

export { buildStyles, SRC_PATH, TARGET_PATH, IS_CONCAT_CSS };
