// Load plugins
var $        = require('gulp-load-plugins')(),
  argv     = require('yargs').argv,
  browser  = require('browser-sync'),
  gulp     = require('gulp'),
  panini   = require('panini'),
  sequence = require('run-sequence'),
  sherpa   = require('style-sherpa'),
  rimraf   = require('rimraf'),
  plugins = require('gulp-load-plugins')({ camelize: true }),
	lr = require('tiny-lr'),
	server = lr();

// Check for --production flag
var isProduction = !!(argv.production);

console.log(isProduction);
console.log(argv);

// Port to use for the development server.
var PROXY = "sand.dev/wordpress";
var PORT = "3001";

// Browsers to target when prefixing CSS.
var COMPATIBILITY = ['last 2 versions', 'ie >= 9'];

// File paths to various assets are defined here.
var PATHS = {
  templates: [
    '*.php',
    'templates/*.php'
  ],
  sass: [
    'assets/vendor/foundation-sites/scss',
    'assets/vendor/foundation-icon-fonts/*.scss',
    'assets/vendor/motion-ui/src/',
    'assets/styles/**/*.scss',
    'assets/styles/*.scss'
  ],
  vendorjs: [
    'assets/js/source/plugins.js',
    'assets/js/vendor/*.js',
    'assets/vendor/jquery/dist/jquery.js',
    'assets/vendor/what-input/what-input.js',
    'assets/vendor/foundation-sites/js/foundation.core.js',
    'assets/vendor/foundation-sites/js/foundation.util.*.js',
    /* Optional Paths to individual JS components defined below */
    //'assets/vendor/foundation-sites/js/foundation.abide.js',
    //'assets/vendor/foundation-sites/js/foundation.accordion.js',
    //'assets/vendor/foundation-sites/js/foundation.accordionMenu.js',
    //'assets/vendor/foundation-sites/js/foundation.drilldown.js',
    'assets/vendor/foundation-sites/js/foundation.dropdown.js',
    'assets/vendor/foundation-sites/js/foundation.dropdownMenu.js',
    //'assets/vendor/foundation-sites/js/foundation.equalizer.js',
    //'assets/vendor/foundation-sites/js/foundation.interchange.js',
    //'assets/vendor/foundation-sites/js/foundation.magellan.js',
    'assets/vendor/foundation-sites/js/foundation.offcanvas.js',
    //'assets/vendor/foundation-sites/js/foundation.orbit.js',
    //'assets/vendor/foundation-sites/js/foundation.responsiveMenu.js',
    //'assets/vendor/foundation-sites/js/foundation.responsiveToggle.js',
    //'assets/vendor/foundation-sites/js/foundation.reveal.js',
    //'assets/vendor/foundation-sites/js/foundation.slider.js',
    'assets/vendor/foundation-sites/js/foundation.sticky.js',
    //'assets/vendor/foundation-sites/js/foundation.tabs.js',
    //'assets/vendor/foundation-sites/js/foundation.toggler.js',
    //'assets/vendor/foundation-sites/js/foundation.tooltip.js',
  ],
  localjs: [
    'assets/js/source/*.js',
    '!assets/js/source/plugins.js'
  ],
  images: [
    'assets/images/**/*'
  ]
};

// Delete the build folders every time a build starts
gulp.task('sass-min', function(done) {
  rimraf('assets/styles/min', done);
});

gulp.task('sass-dist', function(done) {
  rimraf('assets/styles/dist', done);
});

gulp.task('js-dist', function(done) {
  rimraf('assets/js/dist', done);
});

//Styleguide
gulp.task('styleguide', function(done) {
  sherpa('assets/styleguide/index.md', {
    output: 'styleguide.php',
    template: 'assets/styleguide/template.html'
  }, function() {
    browser.reload;
    done();
  });
});

// Styles
gulp.task('styles', function() {
  return gulp.src(PATHS.sass)
	.pipe(plugins.rubySass({ style: 'expanded', sourcemap: true }))
	.pipe(plugins.autoprefixer('last 2 versions', 'ie 9', 'ios 6', 'android 4'))
	//.pipe(gulp.dest('assets/styles/dist'))
	.pipe(plugins.minifyCss({ keepSpecialComments: 1 }))
	.pipe(plugins.livereload(server))
	.pipe(gulp.dest('assets/styles/min'))
	.pipe(plugins.notify({ message: 'Styles task complete' }));
});

// Vendor Plugin Scripts
gulp.task('plugins', function() {
  return gulp.src(PATHS.vendorjs)
	.pipe(plugins.concat('plugins.js'))
	.pipe(gulp.dest('assets/js/dist'))
	.pipe(plugins.rename({ suffix: '.min' }))
	.pipe(plugins.uglify())
	.pipe(plugins.livereload(server))
	.pipe(gulp.dest('assets/js'))
	.pipe(plugins.notify({ message: 'Vendor scripts task complete' }));
});

// Site Scripts
gulp.task('scripts', function() {
  return gulp.src(PATHS.localjs)
	.pipe(plugins.jshint('.jshintrc'))
	.pipe(plugins.jshint.reporter('default'))
	.pipe(plugins.concat('main.js'))
	.pipe(gulp.dest('assets/js/dist'))
	.pipe(plugins.rename({ suffix: '.min' }))
	.pipe(plugins.uglify())
	.pipe(plugins.livereload(server))
	.pipe(gulp.dest('assets/js'))
	.pipe(plugins.notify({ message: 'Local scripts task complete' }));
});

// Images
gulp.task('images', function() {
  return gulp.src(PATHS.images)
	.pipe(plugins.cache(plugins.imagemin({ optimizationLevel: 7, progressive: true, interlaced: true })))
	.pipe(plugins.livereload(server))
	.pipe(gulp.dest('assets/images'))
	.pipe(plugins.notify({ message: 'Images task complete' }));
});

// Start a server with LiveReload to preview the site in
gulp.task('server', function() {
  browser.init({
    proxy: {
      target: PROXY
    }
  });
});

// Watch
gulp.task('watch', function() {

  // Listen on port 35729
  server.listen(35729, function (err) {
	if (err) {
	  return console.log(err)
	};

  // Watch template files
  //gulp.watch('*.php', ['templates']);

	// Watch .scss files
	gulp.watch(PATHS.sass, ['styles']);
	// Watch .js files
	gulp.watch([PATHS.vendorjs, PATHS.localjs], ['plugins', 'scripts']);
	// Watch image files
	gulp.watch(PATHS.images, ['images']);

  });

});

// Default task
gulp.task('default', ['sass-min','sass-dist','js-dist','styleguide', 'styles', 'plugins', 'scripts', 'images', 'server', 'watch']);
