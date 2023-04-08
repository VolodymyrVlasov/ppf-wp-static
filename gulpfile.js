

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
//

let projectFolder = require("path").basename(__dirname);
const PROJECT_FOLDER = projectFolder;
const SOURCE_FOLDER = "#src";


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
    webpHtml = require('gulp-webp-html'),
    htmlminify = require("gulp-html-minify");

const cleanTask = () => {
    return gulp.src('dist/print-sticker/*', { allowEmpty: true })
        .pipe(clean({ force: true }))
};

const htmlTask = () => {
    return src("dev/pages/**/*.html", { allowEmpty: true })
        .pipe(fileInclude({
            prefix: '@@',
            basepath: '@file'
        }))
        .pipe(htmlminify())
        .pipe(dest("dist/"));
};

const replaceImgToPicture = () => {
    return src("./dist//**/*.html")
        .pipe(webpHtml())
        .pipe(dest("./dist/"));
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
    return gulp.src('dev/styles/*.css')
        .pipe(concat('style.css'))
        .pipe(gulp.dest('dist/wp-content/themes/paperfox/styles/'));
};

const jsAppTask = () => {
    return gulp.src('dev/src/scripts/*.js')
        .pipe(gulp.dest('dist/wp-content/themes/paperfox/js/'))
};

const phpAppTask = () => {
    return gulp.src("dev/pages/wp-content/**/*.php", { allowEmpty: true })
        .pipe(dest("dist/wp-content/"))
}

const build = () => {
    return gulp.watch('dev/pages/**/*', gulp.series(copyStaticContent, convertToWebp, cssTask, phpAppTask, htmlTask, jsAppTask));
};

const watch = () => {
    return gulp.watch('dev/pages/**/*', gulp.series(copyStaticContent, convertToWebp, cssTask, phpAppTask, htmlTask, jsAppTask, replaceImgToPicture));
};

// exports.default = gulp.series(changeSrcInHTML, changeUrlInCSS);

exports.replaceImgToPicture = replaceImgToPicture;
exports.copyStaticContent = copyStaticContent;
exports.convertToWebp = convertToWebp;
exports.phpAppTask = phpAppTask;
exports.changeSrcInHTML = changeSrcInHTML;
exports.changeUrlInCSS = changeUrlInCSS;
exports.jsAppTask = jsAppTask;
exports.cleanTask = cleanTask;
exports.cssTask = cssTask;
exports.build = build;
exports.htmlTask = htmlTask;
exports.watch = watch;
exports.default = watch;