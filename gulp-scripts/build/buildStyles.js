// import gulp from "gulp";
// import replace from "gulp-replace";
// import { deleteSync } from "del";

// const SRC_PATH = "dev/styles/";
// const TARGET_PATH = "dist/paperfox/";

// const buildStyles = (vars) => {
//   try {
//     deleteSync(TARGET_PATH + "**/*.css");
//     let streamCss = gulp.src(SRC_PATH + "**/*.css", {
//       base: SRC_PATH,
//       alowEmpty: true,
//     });

//     for (const [placeholder, value] of Object.entries(vars)) {
//       streamCss = streamCss.pipe(replace(placeholder, value));
//     }

//     streamCss.pipe(gulp.dest(TARGET_PATH));
//     return true;
//   } catch (error) {
//     return false;
//   }
// };

// export { buildStyles, SRC_PATH, TARGET_PATH };


// ./gulp-scripts/build/buildStyles.js
import gulp from "gulp";
import replace from "gulp-replace";
import { deleteSync } from "del";

const SRC_PATH = "dev/styles/";
const TARGET_PATH = "dist/paperfox/";

// утиліта: чекати завершення gulp stream
function waitForStream(stream) {
  return new Promise((resolve, reject) => {
    stream.once("finish", resolve).once("end", resolve).once("error", reject);
  });
}

const buildStyles = async (vars = {}) => {
  try {
    // чистимо css перед збіркою
    deleteSync([`${TARGET_PATH}**/*.css`], { force: true });

    // беремо всі css з dev/styles
    let streamCss = gulp.src(`${SRC_PATH}**/*.css`, {
      base: SRC_PATH,
      allowEmpty: true, // виправив
    });

    // замінюємо плейсхолдери
    for (const [placeholder, value] of Object.entries(vars)) {
      streamCss = streamCss.pipe(replace(placeholder, value));
    }

    // кладемо в dist/paperfox
    streamCss = streamCss.pipe(gulp.dest(TARGET_PATH));

    await waitForStream(streamCss);
    return true;
  } catch (error) {
    console.error("---> BuildStyles interrupted.", error);
    throw error;
  }
};

export { buildStyles, SRC_PATH, TARGET_PATH };
