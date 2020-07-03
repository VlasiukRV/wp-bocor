config = require('../config.js').util;

var gulp 	= require('gulp'),
    del 	= require('del'),
    vinylPaths = require('vinyl-paths'),
    sizereport 	= require('gulp-sizereport');

// Deletes all files in build. 

gulp.task('clean', function () {
	return del(config.build);
});

// Deletes all files in dist. 

gulp.task('clean-dist', function(cb) {
    var pattern = [config.dist+'/**/*/', '!'+config.dist+'/**/.git*/'];
    return del(pattern, {force: true});
});

// Size report for files in dist. 

gulp.task('sizereport', function() {
	return gulp.src(config.dist)
		.pipe(sizereport(config.sizereport));
});

