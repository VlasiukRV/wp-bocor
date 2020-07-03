var config = require('../config.js').theme;

var gulp		= require('gulp'),
	changed		= require('gulp-changed');
	
// Copy theme files 

gulp.task('copy-theme', function() {
	return gulp.src(config.src)
		.pipe(changed(config.build.dest))
		.pipe(gulp.dest(config.build.dest));

});

gulp.task('copy-theme-dist', function() {
    return gulp.src(config.src)
        .pipe(changed(config.dist.dest))
        .pipe(gulp.dest(config.dist.dest));

});
