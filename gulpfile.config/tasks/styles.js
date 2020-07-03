var config = require('../config').styles;

var gulp			= require('gulp'),
    sass			= require('gulp-sass'),
    autoprefixer 	= require('gulp-autoprefixer'),
    sourcemaps 		= require('gulp-sourcemaps'),
    cssnano 		= require('gulp-cssnano'),
	browserSync		= require('browser-sync');

// Development task for CSS. This creates sourcemaps, compiles sass and runs the code through autoprefixer.
// After finishing, it will inject the changes into the browser window through BrowserSync.

gulp.task('styles', function() {
	return gulp.src(config.src)
	.pipe(sourcemaps.init())
	.pipe(sass(config.sass))
	.pipe(autoprefixer(config.autoprefixer))
	.pipe(sourcemaps.write())
	.pipe(gulp.dest(config.build.dest))
	.pipe(browserSync.stream());
});

// Production task for CSS. It's the same as in production, but it will minify the resulting css with cssnano. 

gulp.task('styles-dist', function() {
	return gulp.src(config.src)
	.pipe(sourcemaps.init())
	.pipe(sass(config.sass))
	.pipe(autoprefixer(config.autoprefixer))
	.pipe(cssnano())
	.pipe(sourcemaps.write())
	.pipe(gulp.dest(config.dist.dest));
});
