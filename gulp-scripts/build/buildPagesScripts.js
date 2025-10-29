// ./gulp-scripts/build/buildPagesScripts.js
import gulp from "gulp";
import { deleteSync } from "del";

const SRC_PATH = ["dev/src/**/*.js"];
const TARGET_PATH = "dist/src/";

// утиліта: чекати завершення gulp stream
function waitForStream(stream) {
  return new Promise((resolve, reject) => {
    stream.once("finish", resolve).once("end", resolve).once("error", reject);
  });
}

const buildPagesScripts = async () => {
  try {
    // чистимо папку перед копіюванням
    deleteSync([`${TARGET_PATH}**/*.js`], { force: true });

    // копіюємо JS з dev/src у dist/src
    const stream = gulp
      .src(SRC_PATH, { allowEmpty: true }) // виправив помилку
      .pipe(gulp.dest(TARGET_PATH));

    await waitForStream(stream);
    return true; // опційно, для зручності в логіці build+deploy
  } catch (error) {
    console.error("---> BuildPagesScripts interrupted. " + error);
    throw error; // щоб gulp бачив фейл
  }
};

export { buildPagesScripts, SRC_PATH, TARGET_PATH };
