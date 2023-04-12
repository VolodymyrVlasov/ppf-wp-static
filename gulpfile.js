let gulp = require("gulp"),
    fileInclude = require('gulp-file-include'),
    concat = require('gulp-concat'),
    replace = require('gulp-replace'),
    webp = require('gulp-webp'),
    webpHtml = require("gulp-webp-html-nosvg"),
    htmlminify = require("gulp-html-minify");

const buildWPTheme = (done) => {
    gulp.src("dev/wp-theme/**/*.php", { allowEmpty: true })
        .pipe(fileInclude({ prefix: '@@', basepath: '@file' }))
        .pipe(gulp.dest("dist/paperfox/"));

    gulp.src("dev/styles/**/*.css")
        .pipe(concat('style.css'))
        .pipe(gulp.dest("dist/paperfox/"));

    gulp.src("dev/static/**/*")
        .pipe(gulp.dest("dist/paperfox/static/"));

    gulp.src('dev/paperfox/static/**/*.{jpg,jpeg,png}')
        .pipe(webp({ quality: 80 }))
        .pipe(gulp.dest('dist/paperfox/static/'));

    return done();
}

const buildStaticPages = (done) => {
    gulp.src(["dev/pages/**/*.html", "!dev/pages/template-page.html", "!dev/pages/test.html"], { aloowEmpty: true })
        .pipe(fileInclude({ prefix: '@@', basepath: '@file' }))
        .pipe(webpHtml())
        .pipe(htmlminify())
        .pipe(gulp.dest("dist/www/"));

    gulp.src(['dev/styles/*.css', '!dev/styles/_1_wp-theme.css', '!dev/styles/style.css'])
        .pipe(concat('style.css'))
        .pipe(gulp.dest("dist/www/"));

    gulp.src("dev/static/**/*")
        .pipe(webp({ quality: 90 }))
        .pipe(gulp.dest("dist/www/static/"));

    return done();
}

const devStaticPages = (done) => {
    gulp.src(["dev/pages/**/*.html", "!dev/pages/template-page.html", "!dev/pages/test.html"], { aloowEmpty: true })
        .pipe(fileInclude({ prefix: '@@', basepath: '@file' }))
        .pipe(webpHtml())
        .pipe(gulp.dest("devPreview/"));

    gulp.src(['dev/styles/style.css'])
        .pipe(gulp.dest("devPreview/"));

    gulp.src(['dev/styles/*.css'])
        .pipe(gulp.dest("devPreview/styles/"));

    gulp.src("devPreview/styles/*.css")
        .pipe(replace('url("./static', 'url("../static'))
        .pipe(gulp.dest("devPreview/styles/"));

    gulp.src("dev/static/**/*")
        .pipe(gulp.dest("devPreview/static/"))
        .pipe(webp({ quality: 90 }))
        .pipe(gulp.dest("devPreview/static/"));

    return done();
}

exports.buildtheme = buildWPTheme;
exports.buildpages = buildStaticPages;
exports.devwatch = devStaticPages;

exports.default = gulp.series(devStaticPages);