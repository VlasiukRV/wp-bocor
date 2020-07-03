var config = require('../config').watch;

var gulp = require('gulp');

// Check for changes to run the tasks as needed. 

gulp.task('watch', ['browsersync'], function () {
    gulp.watch(config.spg_icons, ['spg_icons']);
	gulp.watch(config.styles, ['styles']);
	gulp.watch(config.scripts, ['scripts']);
	gulp.watch(config.images, ['images']);
	gulp.watch(config.theme, ['copy-theme']);
	gulp.watch(config.fonts, ['fonts']);
});
