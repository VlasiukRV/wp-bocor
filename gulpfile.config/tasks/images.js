var config = require('../config').images;

var gulp 	= require('gulp'),
    changed 	= require('gulp-changed'),
    imagemin 	= require('gulp-imagemin');


// Copy images from src to build

gulp.task('images', function() {
	return gulp.src(config.src)
		.pipe(changed(config.build.dest))
		.pipe(gulp.dest(config.build.dest));
});

// Minify images with imagemin from src and copy them to dist

gulp.task('images-dist', function () {
	return gulp.src(config.src)
		.pipe(imagemin(config.imagemin))
		.pipe(gulp.dest(config.dist.dest));
});
