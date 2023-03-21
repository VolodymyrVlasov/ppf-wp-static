// const gulp = require('gulp');
// const htmlmin = require('gulp-htmlmin');
// const rename = require('gulp-rename');
// const fileInclude = require('gulp-file-include');
// const clean = require('gulp-clean');
// const concat = require('gulp-concat');
// const groupCssMediaQueries = require('gulp-group-css-media-queries');

// gulp.task('devout', () => {
//     return gulp.src(['dev/components/dev-templates/*.html'], { allowEmpty: true })
//         // .pipe(htmlmin({ collapseWhitespace: true }))
//         // .pipe(rename({ suffix: '.min' }))
//         .pipe(fileInclude({
//             prefix: '@@',
//             basepath: '@file'
//         }))
//         .pipe(htmlmin({
//             // collapseWhitespace: true,
//             removeComments: true
//         }))
//         .pipe(gulp.dest('./dev-watch/components/'));
// });

// gulp.task('devout-clean', () => {
//     return gulp.src('./dev-watch')
//         .pipe(clean({ force: true }))
// });

// gulp.task('group-css-media', () => {
//     return gulp.src('dev/styles/*')
//         .pipe(concat('style.css'))
//         .pipe(groupCssMediaQueries()) // Объединяем повторяющиеся медиа-запросы
//         .pipe(gulp.dest('dev-watch/styles/'));
// });





// gulp.task('devwatch', () => {
//     return gulp.watch('dev/**/*', gulp.series('devout-clean', 'devout'));
// });

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

const path = {
    build: {
        html: PROJECT_FOLDER + "/dist/**/*.html",
        css: PROJECT_FOLDER + "/css/",
        js: PROJECT_FOLDER + "/js/",
        img: PROJECT_FOLDER + "/img/",
        fonts: PROJECT_FOLDER + "/fonts/",
    },
    src: {
        html: SOURCE_FOLDER + "dev/pages/**/*.html",
        css: SOURCE_FOLDER + "dev/styles/*.css",
        js: SOURCE_FOLDER + "dev/src/**/*.js",
        img: SOURCE_FOLDER + "dev/static/**/*.{jpg,png,svg,gif,ico,webp}",
        fonts: SOURCE_FOLDER + "dev/fonts/*.ttf",
    },
    watch: {
        html: SOURCE_FOLDER + "dist/",
        css: SOURCE_FOLDER + "dist/styles/*.css",
        js: SOURCE_FOLDER + "dist/src/**/*.js",
        img: SOURCE_FOLDER + "dist//static/**/*.{jpg,png,svg,gif,ico,webp}",
    },
    clean: "./" + PROJECT_FOLDER + "/"
}

let { src, dest } = require("gulp"),
    gulp = require("gulp"),
    browsersync = require("browser-sync").create(),
    fileInclude = require('gulp-file-include'),
    concat = require('gulp-concat'),
    clean = require('gulp-clean'),
    replace = require('gulp-replace');

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
        .pipe(dest("dist/"));
};

const staticContentTask = () => {
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

exports.changeSrcInHTML = changeSrcInHTML;
exports.changeUrlInCSS = changeUrlInCSS;
exports.default = gulp.series(changeSrcInHTML, changeUrlInCSS);
const cssTask = () => {
    return gulp.src('dev/styles/*.css')
        .pipe(concat('style.css'))
        .pipe(gulp.dest('dist/wp-content/themes/paperfox/styles/'));
};

const browserSync = () => {
    return gulp.watch('dev/**/*', gulp.series(cssTask, htmlTask, staticContentTask));
};

// let build = gulp.series(clean, cssTask, htmlTask);
let watch = gulp.parallel(browserSync);


exports.changeSrcInHTML = changeSrcInHTML;
exports.changeSrcInHTML = changeSrcInHTML;

exports.cleanTask = cleanTask;
exports.cssTask = cssTask;
exports.browserSync = browserSync;
exports.htmlTask = htmlTask;
exports.watch = watch;
exports.default = browserSync;