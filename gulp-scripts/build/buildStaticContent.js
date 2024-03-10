import gulp from "gulp";

const SRC_PATH = ["dev/static/**/*"];
const TARGET_PATH = "dist/paperfox/static/";
const QUALITY_FACTOR = 80;

const buildStaticContent = () => {
  gulp
    .src(SRC_PATH)
    .pipe(gulp.dest(TARGET_PATH))
    .pipe(webp({ quality: QUALITY_FACTOR }))
    .pipe(gulp.dest(TARGET_PATH));
};

export { buildStaticContent, SRC_PATH, TARGET_PATH };
