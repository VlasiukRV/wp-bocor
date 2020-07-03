var config = require('../config').scripts;

var gulp 	= require('gulp'),
    concat 	= require('gulp-concat'),
    uglify 	= require ('gulp-uglify'),
    eslint 	= require('gulp-eslint'),
    sourcemaps 	= require('gulp-sourcemaps'),
    babel 	= require('gulp-babel');

// Run ESLint to check for errors .

gulp.task('lint', function(){
	return gulp.src(config.src)
		.pipe(eslint(config.eslint))
		.pipe(eslint.format())
		.pipe(eslint.failAfterError());
});

// Developemnt task for scripts. This make sourcemaps and concatate scripts into one file.

gulp.task('scripts', ['lint'],  function() {
	return gulp.src(config.src)
		.pipe(sourcemaps.init())
		.pipe(babel(config.babel))
		.pipe(concat('scripts.js'))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(config.build.dest));
});

//  Production task for scripts. It does the same as development, but it also minifies the output file.

gulp.task('scripts-dist', ['lint'],  function() {
	return gulp.src(config.src)
		.pipe(sourcemaps.init())
		.pipe(babel(config.babel))
		.pipe(concat('scripts.js'))
		.pipe(uglify())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(config.dist.dest));
});
		


