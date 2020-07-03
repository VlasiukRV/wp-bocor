var gulp	 	= require('gulp'),
    sequence	= require('gulp-sequence');

// Run watch > browsersync > build as default task
gulp.task('default', ['watch']);

// Development task.  Copy developemnt assets to ./wordpress/wp-content/themes
gulp.task('build', sequence('clean', ['spg_icons', 'images', 'scripts', 'styles', 'fonts', 'copy-theme']));

// Production task. Minify and copy assets to ./dist
gulp.task('dist', sequence('clean-dist', ['images-dist', 'scripts-dist', 'styles-dist', 'fonts-dist', 'copy-theme-dist'], 'sizereport'));