// json-config
var json		= require('json-file');
// WordPress theme
var	themeName	= json.read('./package.json').get('themeName');

// Directories

var
    node_modules = './node_modules/',
    assets 	= './assets/',
    src 	= assets + 'theme/',
    dst 	= './dist/' + themeName + '/',
    bld 	= './wp-app/wp-content/themes/' + themeName + '/';

// Module Config

module.exports = {

    browsersync: {
        files: [bld + '/**', '!' + bld + '/**.map'],
        notify: false,
        open: true, // Set to false if you don't like the browser window opening automatically
        port: 7000, // Port number for the live version of the site; default: 3000
        proxy: 'localhost:7000',
        watchOptions: {
            debounceDelay: 2000
        }
    },

    styles: {
        src: [assets+'sass/**/*.sass', assets+'sass/**/*.scss'],
        build: { dest: bld+'/css/'},
        dist: { dest: dst+'/css/'},
        autoprefixer: {
            browsers: ['last 2 versions'],
            cascade: false
        },
        sass: {
            includePaths: [assets+'sass'],
            indentedSyntax: false
        }
    },

    scripts: {
        src: [node_modules+'jquery-validation/dist/jquery.validate.js', assets+'js/**/*.js'],
        build: { dest: bld+'js/' },
        dist: { dest: dst+'js/' },
        babel: { presets: ['es2015'] },
        eslint: { config: './.eslintrc' }
    },

    images: {
        src: assets+'img/**',
        build: { dest: bld+'img' },
        dist: { dest: dst+'img' },
        imagemin: {
            progressive: true,
            svgoPlugins: [{removeViewBox: false}]
        }
    },

    watch : {
        styles : assets+'sass/**/*(*.sass|*.scss)',
        scripts : assets+'js/**/*.js',
        images : assets+'img/**/*(*.png|*.jpg|*.jpeg|*.gif|*.svg)',
        fonts: assets+'ttf/**/*.ttf',
        theme: src+'**/*.php'
    },

    util : {
        build: bld,
        dist: dst,
        sizereport: {
            gzip: true
        }
    },

    fonts : {
        src: assets+'ttf/**/*.ttf',
        build: { dest: bld+'ttf' },
        dist: { dest: dst+'ttf' }
    },

    theme : {
        src: [src+'**/*.php', src+'**/*.html', src+'readme.txt', src+'screenshot.png', src+'style.css'],
        build: { dest: bld},
        dist: { dest: dst}
    },

};