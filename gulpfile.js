// ***CSS***
// gulp-scss -> action({outputStyle: "expanded"})
// gulp-autoprefixer -> action({overrideBrowserlist: ["last 5 versions"], cascade: true})
// gulp-group-css-media-queries -> action()
// gulp-clean-css -> action()
// gulp-rename -> action({extname: "min.css"})

// ***JS***
// gulp-uglify-es -> require("gulp-uglify-es").default;

// ***IMAGES***
// gulp-imagemin -> action({progressive: true, svgoPlugins: [{removeViewBox: false}], interlaced: true, optimizationLevel: 0-7})
// gulp-webp -> action({quality: 70})
// in HTML task!!! -> gulp-webp-html -> action()
// in CSS task!!! -> gulp-webpcss -> action()

// ***FONTS***
// gulp-ttf2woff gulp-ttf2woff2 
// gulp-fonter -> action({formats: ['ttf']) -> destination src folder

// let projectFolder = require("path").basename(__dirname);

// let projectFolder = require("path").basename(__dirname);
// const PROJECT_FOLDER = projectFolder;
// const SOURCE_FOLDER = "#src";


let { src, dest } = require("gulp"),
    gulp = require("gulp"),
    browsersync = require("browser-sync").create(),
    fileInclude = require('gulp-file-include'),
    concat = require('gulp-concat'),
    clean = require('gulp-clean'),
    replace = require('gulp-replace'),
    // imagemin = require('gulp-imagemin'),
    webp = require('gulp-webp'),
    // rename = require('gulp-rename'),
    // webpHtml = require('gulp-webp-html'),
    webpHtml = require("gulp-webp-html-nosvg"),
    htmlminify = require("gulp-html-minify"),
    prettier = require('gulp-prettier'),
    yargs = require('yargs');;


const wpTheme = (done) => {
    gulp.src("dev/wp-theme/**/*.php", { allowEmpty: true })
        .pipe(fileInclude({
            prefix: '@@',
            basepath: '@file'
        }))
        .pipe(dest("dist/paperfox/"));

    gulp.src("dev/styles/**/*.css")
        .pipe(concat('style.css'))
        .pipe(dest("dist/paperfox/"));

    gulp.src("dev/static/**/*")
        .pipe(dest("dist/paperfox/static/"));

    gulp.src('dev/paperfox/static/**/*.{jpg,jpeg,png}')
        .pipe(webp({ quality: 80 }))
        .pipe(gulp.dest('dist/paperfox/static/'));

    return done();
}

const staticPages = (done) => {
    gulp.src(["dev/pages/**/*.html", "!dev/pages/template-page.html", "!dev/pages/test.html"], { aloowEmpty: true })
        .pipe(fileInclude({
            prefix: '@@',
            basepath: '@file'
        }))
        .pipe(dest("dist/www/"));

    gulp.src("dist/www/**/*.html")
        .pipe(webpHtml())
        .pipe(dest("dist/www/"));

    gulp.src(['dev/styles/*.css', '!dev/styles/_1_wp-theme.css', '!dev/styles/style.css'])
        .pipe(concat('style.css'))
        .pipe(dest("dist/www/"));

    gulp.src("dev/static/**/*")
        .pipe(dest("dist/www/static/"));

    gulp.src('dev/www/static/**/*.{jpg,jpeg,png}')
        .pipe(webp({ quality: 80 }))
        .pipe(gulp.dest('dist/www/static/'));

    return done();
}

const devStaticPages = (done) => {
    gulp.src(["dev/pages/**/*.html", "!dev/pages/template-page.html", "!dev/pages/test.html"], { aloowEmpty: true })
        .pipe(fileInclude({
            prefix: '@@',
            basepath: '@file'
        }))
        .pipe(dest("devPreview/"));

    gulp.src("devPreview/**/*.html")
        .pipe(webpHtml())
        .pipe(dest("devPreview/"));

    gulp.src(['dev/styles/style.css'])
        .pipe(dest("devPreview/"))

    gulp.src(['dev/styles/*.css'])
        .pipe(dest("devPreview/styles/"));

    gulp.src("devPreview/styles/*.css")
        .pipe(replace('url("./static', 'url("../static'))
        .pipe(dest("devPreview/styles/"));

    gulp.src("dev/static/**/*")
        .pipe(dest("devPreview/static/"));

    gulp.src('devPreview/static/**/*.{jpg,jpeg,png}')
        .pipe(webp({ quality: 30 }))
        .pipe(gulp.dest('devPreview/static/'));

    return done();
}







const htmlTask = () => {
    return src("dev/pages/**/*.html")
        .pipe(fileInclude({
            prefix: '@@',
            basepath: '@file'
        }))
        .pipe(htmlminify())
        .pipe(webpHtml({ replace_picture_element: false }))
        .pipe(dest("dist/www/"));
};

const phpAppTask = () => {
    return gulp.src("dev/pages/wp-content/**/*.php", { allowEmpty: true })
        .pipe(fileInclude({
            prefix: '@@',
            basepath: '@file'
        }))
        .pipe(dest("dist/paperfox/"))
}

const replaceImgToPicture = () => {
    return src("dist/print-sticker/*.html")
        .pipe(webpHtml())
        .pipe(dest("dist/"));
}

const convertToWebp = () => {
    return gulp.src('dist/wp-content/themes/paperfox/static/**/*.{jpg,jpeg,png}')
        .pipe(webp({ quality: 100 }))
        .pipe(gulp.dest('dist/wp-content/themes/paperfox/static/'));
}

const copyStaticContent = () => {
    return src("dev/static/**/*", { allowEmpty: true })
        .pipe(dest("dist/wp-content/themes/paperfox/static/"));
};

const changeSrcInHTML = () => {
    return gulp.src("dev/pages/**/*.html")
        .pipe(replace(/src="\/dist\/([^"]*)"/g, 'src="$1"'))
        .pipe(gulp.dest('dist'));
}

const changeUrlInCSS = () => {
    return gulp.src('dev/styles/*.css')
        .pipe(replace(/url\(\/dist\/([^)]*)\)/g, 'url($1)'))
        .pipe(gulp.dest('dist/styles'));
}

const cssTask = () => {
    return gulp.src(['dev/styles/*.css', '!dev/styles/_1_wp-theme.css'])
        .pipe(concat('style.css'))
        .pipe(gulp.dest('dist/wp-content/themes/paperfox/styles/'));
};

const jsAppTask = () => {
    return gulp.src('dev/src/**/*.js')
        .pipe(gulp.dest('dist/wp-content/themes/paperfox/js/'))
};


const watchFiles = () => {
    return gulp.watch('dev/static/**/*', gulp.series(copyStaticContent, convertToWebp));
};

const watchCode = () => {
    return gulp.watch(['dev/pages/**/*', 'dev/styles/**/*'], gulp.series(cssTask, phpAppTask, htmlTask, jsAppTask));
};

const watch = () => {
    return gulp.parallel(watchFiles, watchCode);
}

exports.wpTheme = wpTheme;
exports.staticPages = staticPages;
exports.devStaticPages = devStaticPages;


exports.replaceImgToPicture = replaceImgToPicture;
exports.copyStaticContent = copyStaticContent;
exports.convertToWebp = convertToWebp;
exports.phpAppTask = phpAppTask;
exports.changeSrcInHTML = changeSrcInHTML;
exports.changeUrlInCSS = changeUrlInCSS;
exports.jsAppTask = jsAppTask;
exports.cssTask = cssTask;
exports.htmlTask = htmlTask;
exports.watchFiles = watchFiles;
exports.watchCode = watchCode;
exports.watch = watch;
exports.default = gulp.series(copyStaticContent, convertToWebp, cssTask, phpAppTask, htmlTask, jsAppTask, gulp.parallel(watchCode, watchFiles));