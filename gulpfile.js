const gulp = require('gulp');
const htmlmin = require('gulp-htmlmin');
const rename = require('gulp-rename');
const fileInclude = require('gulp-file-include');
const clean = require('gulp-clean');


gulp.task('devout', () => {
    return gulp.src(['dev/components/dev-templates/*.html'], { allowEmpty: true })
        // .pipe(htmlmin({ collapseWhitespace: true }))
        // .pipe(rename({ suffix: '.min' }))
        .pipe(fileInclude({
            prefix: '@@',
            basepath: '@file'
        }))
        .pipe(htmlmin({
            // collapseWhitespace: true,
            removeComments: true
        }))
        .pipe(gulp.dest('./dev-watch/components/'));
});

gulp.task('devout-clean', () => {
    return gulp.src('./dev-watch')
        .pipe(clean({ force: true }))
});

gulp.task('devout-clean-buil-tamplates', () => {
    return gulp.src('./dev-watch/dev-build-templates')
        .pipe(clean({ force: true }))
});




gulp.task('devwatch', () => {
    return gulp.watch('dev/**/*', gulp.series('devout-clean', 'devout'));
});
