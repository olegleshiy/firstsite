let gulp = require('gulp'),
    autoprefixer = require('gulp-autoprefixer');


gulp.task('scss', function () {
    return gulp.src('scss/**/*.scss')
        .pipe(autoprefixer({
            overrideBrowserslist: ['last 8 versions']
        }))
        .pipe(gulp.dest('scss'))
});

gulp.task('start', gulp.parallel('scss'));
