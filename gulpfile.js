import vinylFtp from "vinyl-ftp";
import util from "gulp-util";
import gulp from "gulp";
import fileInclude from "gulp-file-include";
import concat from "gulp-concat";
import replace from "gulp-replace";
import webp from "gulp-webp";
import webpHtml from "gulp-webp-html-nosvg";
import htmlminify from "gulp-html-minify";
import dotenv from "dotenv";
import { deleteSync } from "del";
import { wwwVar } from "./const.js"

dotenv.config();

const ftp = vinylFtp.create({
    host: process.env.FTP_HOST,
    user: process.env.FTP_USER,
    password: process.env.FTP_PASSWORD,
    parallel: 5,
    log: util.log
});

export const clear = (done) => {
    deleteSync(["paperfox/"]);
    deleteSync(["www/"]);
    deleteSync(["devPreview/"]);

    ftp.rmdir("/paperfox.in.ua/shop/wp-content/themes/paperfox", (err) => {
        if (err) {
            console.error('Error deleting directory:', err);
        } else {
            console.log('Directory deleted successfully.');
        }
    });

    ftp.rmdir("/paperfox.in.ua/www", (err) => {
        if (err) {
            console.error('Error deleting directory:', err);
        } else {
            console.log('Directory deleted successfully.');
        }
    });
    done();
}

export const buildwp = (done) => {
    // deleteSync(["paperfox/"]);

    let stream = gulp.src("dev/wp-theme/**/*.php", { aloowEmpty: true })
        .pipe(fileInclude({ prefix: '@@', basepath: '@file' }));

    for (const [placeholder, value] of Object.entries(wwwVar)) {
        stream = stream.pipe(replace(placeholder, value));
    }

    stream
        .pipe(webpHtml())
        .pipe(replace('src="./static', 'src="<?php echo get_template_directory_uri();?>/static'))
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

export const buildpages = (done) => {
    // deleteSync(["www/"]);

    const srcHtml = ["dev/pages/**/*.html", "!dev/pages/template-page.html", "!dev/pages/test.html"];
    const srcCSS = ['dev/styles/*.css', '!dev/styles/_1_wp-theme.css', '!dev/styles/style.css'];
    const srcStatic = "dev/static/**/*.*";

    gulp.src("dev/pages/.htaccess", { aloowEmpty: true })
        .pipe(gulp.dest("www/"))

    let stream = gulp.src(srcHtml, { aloowEmpty: true })
        .pipe(fileInclude({ prefix: '@@', basepath: '@file' }));

    for (const [placeholder, value] of Object.entries(wwwVar)) {
        stream = stream.pipe(replace(placeholder, value));
    }

    stream.
        pipe(webpHtml())
        .pipe(htmlminify())
        .pipe(gulp.dest("www/"));

    gulp.src(srcCSS, { aloowEmpty: true })
        .pipe(concat('style.css'))
        .pipe(gulp.dest("www/"));

    gulp.src(srcStatic, { aloowEmpty: true })
        .pipe(gulp.dest("www/static/"))
        .pipe(webp({ quality: 90 }))
        .pipe(gulp.dest("www/static/"));

    return done();
}

export const dev = (done) => {
    // deleteSync(["devPreview/**", "!devPreview/"]);

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

export const deploywp = (done) => {
    const LOCAL = ['paperfox/**/*.*'];
    const REMOTE = "/paperfox.in.ua/shop/wp-content/themes/paperfox";

    gulp.src(LOCAL, {})
        .pipe(ftp.dest(REMOTE));

    return done();
}

export const deploywww = (done) => {
    const LOCAL = ['www/**/*.*'];
    const REMOTE = "/paperfox.in.ua/www/";

    gulp.src(LOCAL, {})
        .pipe(ftp.dest(REMOTE));

    gulp.src("www/.htaccess", { aloowEmpty: true })
        .pipe(ftp.dest(REMOTE));

    return done();
}

export default () => gulp.watch(["dev/", "!dev/wp-theme"], gulp.series(dev));