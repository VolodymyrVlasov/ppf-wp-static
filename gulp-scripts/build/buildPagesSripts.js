import gulp from "gulp";

const SRC_PATH = ["dev/src/**/*.js"];
const TARGET_PATH = "dist/src/";

const buildPagesScripts = () => {
  gulp.src(SRC_PATH, { aloowEmpty: true }).pipe(gulp.dest(TARGET_PATH));
};

export { buildPagesScripts, SRC_PATH, TARGET_PATH };
 