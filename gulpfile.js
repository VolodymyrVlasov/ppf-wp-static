const gulp = require('gulp');
const htmlmin = require('gulp-htmlmin');
const rename = require('gulp-rename');
const fileInclude = require('gulp-file-include');


// Определяем задачу для сборки и минификации HTML файлов
gulp.task('dev-test-output', 'build-html', () => {
    return gulp.src(['./dev/components/**/*.html', '!dev-build-templates'])
        // .pipe(htmlmin({ collapseWhitespace: true }))
        // .pipe(rename({ suffix: '.min' }))
        .pipe(fileInclude({
            prefix: '@@',
            basepath: '@file'
        }))
        .pipe(gulp.dest('./dist/'));
});

// Задача по умолчанию, которая запускает задачу для сборки и минификации HTML файлов
gulp.task('default', gulp.series('dev-test-output'));



