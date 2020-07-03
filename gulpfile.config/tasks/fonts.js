var config = require('../config').fonts;

var gulp	 	= require('gulp'),
    changed 	= require('gulp-changed')


// Copy fonts from src to build 

gulp.task('fonts', function() {
	return gulp.src(config.src)
		.pipe(changed(config.build.dest))
		.pipe(gulp.dest(config.build.dest));
});

// Same as above but for production 

gulp.task('fonts-dist', function () {
	return gulp.src(config.src)
		.pipe(gulp.dest(config.dist.dest));
});
