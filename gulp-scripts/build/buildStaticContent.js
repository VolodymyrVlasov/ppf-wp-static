import gulp from "gulp";

const SRC_PATH = ["dev/static/**/*"];
const TARGET_PATH = "dist/paperfox/static/";

const buildStaticContent = () => {
  gulp
    .src(SRC_PATH)
    .pipe(gulp.dest(TARGET_PATH))
    .pipe(webp({ quality: 80 }))
    .pipe(gulp.dest(TARGET_PATH));
};

export default buildStaticContent;
