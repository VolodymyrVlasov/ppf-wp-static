import vinylFtp from "vinyl-ftp";
import util from "gulp-util";
import gulp from "gulp";
import fileInclude from "gulp-file-include";
import concat from "gulp-concat";
import sourcemaps from "gulp-sourcemaps";
import replace from "gulp-replace";
import webp from "gulp-webp";
import htmlminify from "gulp-html-minify";
import dotenv from "dotenv";
import { deleteSync } from "del";
import { wwwVar, devVar, wpVar } from "./const.js";

import {
  watchPages,
  watchTheme,
  watchThemeScripts,
} from "./gulp-scripts/watchAndDeployToLocal.js";

import Vinyl from "vinyl";

dotenv.config();

const ftp = vinylFtp.create({
  host: process.env.FTP_HOST,
  user: process.env.FTP_USER,
  password: process.env.FTP_PASSWORD,
  parallel: 15,
  log: util.log,
});

export const clear = (done) => {
  deleteSync(["paperfox/"]);
  // deleteSync(["www/"]);

  ftp.rmdir("/paperfox.in.ua/www/wp-content/themes/paperfox", (err) => {
    if (err) {
      console.error("Error deleting directory:", err);
    } else {
      console.log("Directory deleted successfully.");
    }
  });

  // ftp.rmdir("/paperfox.in.ua/www", (err) => {
  //     if (err) {
  //         console.error('Error deleting directory:', err);
  //     } else {
  //         console.log('Directory deleted successfully.');
  //     }
  // });
  done();
};

export const buildwp = (done) => {
  gulp.src("dev/wp-theme/screenshot.png").pipe(gulp.dest("paperfox/"));

  // BUILD PHP
  let streamPhp = gulp.src(
    ["dev/wp-theme/**/*.php", "!dev/wp-theme/woocommerce/disable-checkout.php"],
    { aloowEmpty: true }
  );
  streamPhp
    .pipe(fileInclude({ prefix: "@@", basepath: "@file" }))
    .pipe(gulp.dest("paperfox/"));

  for (const [placeholder, value] of Object.entries(wpVar)) {
    streamPhp = streamPhp.pipe(replace(placeholder, value));
  }
  streamPhp
    .pipe(webpHtml())
    .pipe(
      replace(
        'src="./static',
        'src="<?php echo get_template_directory_uri();?>/static'
      )
    )
    .pipe(gulp.dest("paperfox/"));

  // BUILD STYLES
  let streamCss = gulp.src("dev/styles/**/*.css", { aloowEmpty: true });

  for (const [placeholder, value] of Object.entries(wpVar)) {
    streamCss.pipe(replace(placeholder, value)).pipe(gulp.dest("paperfox/"));
  }

  // gulp.src(["dev/styles/**/*.css"], { aloowEmpty: true })
  // .pipe(concat('style.css'))

  // BUILD STATIC CONTENT
  gulp
    .src("dev/static/**/*")
    .pipe(webp({ quality: 80 }))
    .pipe(gulp.dest("paperfox/static/"));

  gulp.src("dev/wp-theme/js/**/*").pipe(gulp.dest("paperfox/js/"));

  return done();
};

export const build_wp_plugins = (done) => {
  // deleteSync(["plugins/"]);

  let streamPhp = gulp.src("dev/wp-plugins/**/*.*", { aloowEmpty: true });
  streamPhp.pipe(fileInclude({ prefix: "@@", basepath: "@file" }));

  for (const [placeholder, value] of Object.entries(wpVar)) {
    streamPhp = streamPhp.pipe(replace(placeholder, value));
  }

  streamPhp
    .pipe(
      replace(
        'src="./static',
        'src="<?php echo get_template_directory_uri();?>/static'
      )
    )
    .pipe(gulp.dest("plugins/"));

  return done();
};

export const buildpages = (done) => {
  const srcHtml = [
    "dev/pages/**/*.html",
    "!dev/pages/template-page.html",
    "!dev/pages/test.html",
  ];
  const srcCSS = [
    "dev/styles/*.css",
    "!dev/styles/_1_wp-theme.css",
    "!dev/styles/style.css",
  ];
  const srcStatic = "dev/static/**/*.*";
  const srcScripts = "dev/src/**/*.*";

  gulp.src("dev/pages/.htaccess", { aloowEmpty: true }).pipe(gulp.dest("www/"));

  let streamHtml = gulp
    .src(srcHtml, { aloowEmpty: true })
    .pipe(fileInclude({ prefix: "@@", basepath: "@file" }));

  for (const [placeholder, value] of Object.entries(wwwVar)) {
    streamHtml = streamHtml.pipe(replace(placeholder, value));
  }

  streamHtml
    .pipe(webpHtml())
    // .pipe(htmlminify())
    .pipe(gulp.dest("www/"));

  let streamCss = gulp
    .src(srcCSS, { aloowEmpty: true })
    .pipe(fileInclude({ prefix: "@@", basepath: "@file" }));

  for (const [placeholder, value] of Object.entries(wwwVar)) {
    streamCss = streamCss.pipe(replace(placeholder, value));
  }

  streamCss.pipe(concat("style.css")).pipe(gulp.dest("www/"));

  gulp.src(srcScripts, { aloowEmpty: true }).pipe(gulp.dest("www/src/"));

  gulp
    .src(srcStatic, { aloowEmpty: true })
    .pipe(gulp.dest("www/static/"))
    .pipe(webp({ quality: 90 }))
    .pipe(gulp.dest("www/static/"));

  return done();
};

export const dev = (done) => {
  setTimeout(() => {
    const srcHtml = ["dev/pages/**/*.html"];
    const srcCSS = ["dev/styles/*.css", "!dev/styles/style.css"];
    const srcStatic = "dev/static/**/*.*";
    const srcScripts = "dev/src/**/*.*";

    let streamHtml = gulp.src(srcHtml);
    streamHtml.pipe(fileInclude({ prefix: "@@", basepath: "@file" }));

    for (const [placeholder, value] of Object.entries(devVar)) {
      streamHtml = streamHtml.pipe(replace(placeholder, value));
    }
    streamHtml.pipe(webpHtml()).pipe(gulp.dest("devPreview/"));

    let streamCss = gulp.src(srcCSS, { aloowEmpty: true });

    for (const [placeholder, value] of Object.entries(devVar)) {
      streamCss = streamCss.pipe(replace(placeholder, value));
    }

    streamCss.pipe(gulp.dest("devPreview/styles/"));

    gulp
      .src("dev/styles/style.css")
      .pipe(replace('url("./_', 'url("./styles/_'))
      .pipe(gulp.dest("devPreview/"));

    gulp
      .src(srcScripts, { aloowEmpty: true })
      .pipe(gulp.dest("devPreview/src/"));

    // gulp.src(srcStatic, { aloowEmpty: true })
    //     .pipe(gulp.dest("devPreview/static/"))
    //     .pipe(webp({ quality: 90 }))
    //     .pipe(gulp.dest("devPreview/static/"));

    return done();
  }, 200);
};

export const deploywp = (done) => {
  const LOCAL = ["paperfox/**/*.*"];
  const REMOTE = "/paperfox.in.ua/www/wp-content/themes/paperfox";

  gulp.src(LOCAL, {}).pipe(ftp.dest(REMOTE));

  return done();
};

export const deploywpcode = (done) => {
  const LOCAL = ["paperfox/js/*.*", "paperfox/woocommerce/*.*", "paperfox/*.*"];
  const REMOTE = "/paperfox.in.ua/www/wp-content/themes/paperfox";

  gulp.src(LOCAL, {}).pipe(ftp.dest(REMOTE));

  return done();
};

export const deploywpplugins = (done) => {
  const LOCAL = ["plugins/**/*.*"];
  const REMOTE = "/paperfox.in.ua/www/wp-content/plugins/";

  gulp.src(LOCAL, {}).pipe(ftp.dest(REMOTE));

  return done();
};

export const deploywww = (done) => {
  const LOCAL = ["www/**/*.*", "!www/test/*.*"];
  const REMOTE = "/paperfox.in.ua/www/";

  gulp.src(LOCAL, {}).pipe(ftp.dest(REMOTE));

  gulp.src("www/.htaccess", { aloowEmpty: true }).pipe(ftp.dest(REMOTE));

  return done();
};

export const watchTest = () => {
  watchPages();
  watchTheme();
  watchThemeScripts();
};
