var gulp         = require('gulp');
var $            = require('gulp-load-plugins')();
var browserSync  = require('browser-sync');
var browserify   = require('browserify');
var babelify     = require('babelify');
var debowerify   = require('debowerify');
var source       = require('vinyl-source-stream');
var buffer       = require('vinyl-buffer');
var runSequence  = require('run-sequence');


//
//   Config
//
//////////////////////////////////////////////////////////////////////

var paths = {
  styleSrc: 'src/styles/',
  styleDist: 'dist/styles/',

  scriptSrc: 'src/scripts/',
  scriptDist: 'dist/scripts/',

  templateSrc: '.',

  imageSrc: 'src/images/',
  imageDist: 'images/'
};


//
//   Styles
//
//////////////////////////////////////////////////////////////////////

/*
Preprocesses stylesheets using the following plugins:

cssGlobbing: Allows globbing imports in .scss: @import 'styles/modules/*.scss';
sass: Sass compilation using super-fast libsass
autoprefixer: Automatically adds vendor prefixes to experimental properties
*/

gulp.task('styles', function() {
  return gulp.src([
    paths.styleSrc + 'main.scss',
  ])
  .pipe($.cssGlobbing({
    extensions: ['.scss']
  }))
  .pipe($.sass({
    outputStyle: 'compressed',
    onError: console.error.bind(console, 'Sass error:')
  }))
  .pipe($.autoprefixer({ browsers: ['last 2 versions'] }))
  .pipe(gulp.dest(paths.styleDist))
  .pipe(browserSync.reload({ stream: true }));
});


//
//   Lint
//
//////////////////////////////////////////////////////////////////////

/*
Reviews files for errors and coding consistency 
*/

gulp.task('lint', function() {
  return gulp.src([
    paths.scriptSrc + '**/*.js',
  ])
  .pipe($.eslint({
    configFile: './node_modules/eslint-config-odc/eslintrc.json',
    useEslintrc: false
  }))
  .pipe($.eslint.format())
  .pipe($.eslint.failAfterError());
});


//
//   Scripts
//
//////////////////////////////////////////////////////////////////////

/*
Concatenates and uglifies/minifies scripts

Note: The Babelify transform (which allows the use
of next-generation Javascript syntax using Babel), will slow down
Javascript compilation time. If you don't want/need this,
just remove the following:

- The babelify require at the top of this file
- The babelify transform below
- "babelify" and "gulp-babel" in package.json
*/

gulp.task('scripts', ['lint'], function() {
  browserify({
    entries: paths.scriptSrc + 'main.js',
    debug: true
  })
  .transform(babelify)
  .transform(debowerify)
  .bundle()
  .on('error', function(err) {
    console.log(err.toString());
    this.emit('end');
  })
  .pipe(source('bundle.js'))
  .pipe(buffer())
  .pipe($.uglify())
  .pipe(gulp.dest(paths.scriptDist))
  .pipe(browserSync.reload({ stream: true, once: true }));
});


//
//   Templates
//
//////////////////////////////////////////////////////////////////////

/*
Reloads the browser on changes to templates
*/

gulp.task('templates', function() {
  return gulp.src([
    paths.templateSrc + '**/*.html',
    paths.templateSrc + '**/*.php'
  ])
  .pipe(browserSync.reload({ stream: true, once: true }));
});


//
//   Images
//
//////////////////////////////////////////////////////////////////////

/*
Lossless optimization of image files
*/

gulp.task('images', function() {
  return gulp.src([
    paths.imageSrc + '**/*'
  ])
  .pipe($.imagemin({
    progressive: true,
    svgoPlugins: [{
      cleanupIDs: false,
      collapseGroups: false,
      mergePaths: false,
      moveElemsAttrsToGroup: false,
      moveGroupAttrsToElems: false,
      removeUselessStrokeAndFill: false,
      removeViewBox: false
    }]
  }))
  .pipe(gulp.dest(paths.imageDist));
});


//
//   Bower Install
//
//////////////////////////////////////////////////////////////////////

/*
Make sure all Bower dependencies are installed
*/

gulp.task('bowerInstall', $.shell.task([
  'bower install'
]));


//
//   BrowserSync
//
//////////////////////////////////////////////////////////////////////

/*
Refreses browser on file changes and syncs scroll/clicks between devices.
Your site will be available at http://localhost:3000
*/

gulp.task('browserSync', function() {
  browserSync.init(null, {
    open: false,
    notify: false,

    // If you have your own virtual host, uncomment this line and remove the 'server' property
    proxy: 'http://paws-effect.dev'
  });
});


//
//   Watch
//
//////////////////////////////////////////////////////////////////////

/*
Runs tasks when files change
*/

// Watch
gulp.task('watch', function() {
  gulp.watch([paths.styleSrc + '**/*.scss'], ['styles']);
  gulp.watch([paths.scriptSrc + '**/*.js'], ['lint', 'scripts']);
  gulp.watch([paths.templateSrc + '**/*.html', paths.templateSrc + '**/*.php', paths.templateSrc + '**/*.twig'], ['templates']);
  gulp.watch([paths.imageSrc + '**/*'], ['images']);
});


//
//   Build
//
//////////////////////////////////////////////////////////////////////

/*
Runs all tasks needed to produce a deployable project
*/

gulp.task('build', function(callback) {
  runSequence(
    'bowerInstall',
    [
      'styles',
      'lint',
      'scripts',
      'templates',
      'images'
    ],
    callback
  );
});


//
//   Default
//
//////////////////////////////////////////////////////////////////////

gulp.task('default', function(callback) {
  runSequence(
    'build',
    [
      'browserSync',
      'watch'
    ],
    callback
  );
});
