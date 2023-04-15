let vinylFtp = require("vinyl-ftp"),
    util = require("gulp-util"),
    gulp = require("gulp"),
    fileInclude = require("gulp-file-include"),
    concat = require("gulp-concat"),
    replace = require("gulp-replace"),
    webp = require("gulp-webp"),
    webpHtml = require("gulp-webp-html-nosvg"),
    htmlminify = require("gulp-html-minify"),
    dotenv = require('dotenv');

// Загружаем переменные окружения из файла .env
dotenv.config();

const buildWPTheme = (done) => {
    gulp.src("dev/wp-theme/**/*.php", { allowEmpty: true })
        .pipe(fileInclude({ prefix: '@@', basepath: '@file' }))
        .pipe(webpHtml())
        .pipe(replace('src="./static', 'src=" <?php echo get_template_directory_uri(); ?>/static'))
        .pipe(gulp.dest("paperfox/"));

    gulp.src("dev/wp-theme/screenshot.png")
        .pipe(gulp.dest("paperfox/"));

    gulp.src("dev/styles/**/*.css")
        .pipe(concat('style.css'))
        .pipe(gulp.dest("paperfox/"));

    gulp.src("dev/static/**/*")
        .pipe(webp({ quality: 80 }))
        .pipe(gulp.dest("paperfox/static/"));

    return done();
}

const buildStaticPages = (done) => {
    gulp.src(["dev/pages/**/*.html", "!dev/pages/template-page.html", "!dev/pages/test.html"], { aloowEmpty: true })
        .pipe(fileInclude({ prefix: '@@', basepath: '@file' }))
        .pipe(webpHtml())
        .pipe(htmlminify())
        .pipe(gulp.dest("www/"));

    gulp.src(['dev/styles/*.css', '!dev/styles/_1_wp-theme.css', '!dev/styles/style.css'])
        .pipe(concat('style.css'))
        .pipe(gulp.dest("www/"));

    gulp.src("dev/static/**/*")
        .pipe(webp({ quality: 90 }))
        .pipe(gulp.dest("www/static/"));

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

const deployWP = (done) => {
    const ftp = vinylFtp.create({
        host: process.env.FTP_HOST,
        user: process.env.FTP_USER,
        password: process.env.FTP_PASSWORD,
        parallel: 5,
        log: util.log
    });

    const LOCAL = ['paperfox/**/*.*'];
    const REMOTE = "/paperfox.in.ua/shop/wp-content/themes/paperfox";

    gulp.src(LOCAL, {})
        .pipe(ftp.newer(REMOTE)) // upload only newer files
        .pipe(ftp.dest(REMOTE));

    return done();
}

const deployWWWW = (done) => {
    const ftp = vinylFtp.create({
        host: process.env.FTP_HOST,
        user: process.env.FTP_USER,
        password: process.env.FTP_PASSWORD,
        parallel: 5,
        log: util.log
    });

    const LOCAL = ['www/**/*.*'];
    const REMOTE = "/paperfox.in.ua/www";

    gulp.src(LOCAL, {})
        .pipe(ftp.newer(REMOTE)) // upload only newer files
        .pipe(ftp.dest(REMOTE));

    return done();
}

exports.buildtheme = buildWPTheme;
exports.buildpages = buildStaticPages;
exports.devwatch = devStaticPages;
exports.deploywp = deployWP;
exports.deploywww = deployWWWW;

exports.default = gulp.series(devStaticPages);