var elixir = require('laravel-elixir');
elixir.config.publicPath='compiled';

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

 elixir(function(mix) {
 	mix.copy('vendor/bower_components/open-sans/fonts/','compiled/fonts/')
		.copy('vendor/bower_components/font-awesome-sass/assets/fonts/','compiled/fonts/')
		.copy('vendor/bower_components/jquery/dist/jquery.min.js','resources/assets/js/jquery/')
		.copy('vendor/bower_components/lazyloadxt/dist/jquery.lazyloadxt.extra.js','resources/assets/js/lazyloadxt/')
		.copy('vendor/bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js','resources/assets/js/bootstrap/')
		.copy('vendor/bower_components/scrollmagic/scrollmagic/minified','resources/assets/js/scrollmagic/')
		.copy('vendor/bower_components/gsap/src/minified/','resources/assets/js/greensock/')

		.sass('sass.scss', 'compiled/css',
 	{
 		includePaths:[
	 		__dirname + '/vendor/bower_components',
			__dirname + '/resources/assets/sass',
 		]

 	})
 	.styles(
 		[
 		'sass.css'
 		],null,'compiled/css')
 	 .scripts([
			'greensock/easing/EasePack.min.js',
			'greensock/TweenMax.min.js',
			'greensock/TimelineMax.min.js',
			'jquery/jquery.min.js',
			'bootstrap/bootstrap.min.js',
			'lazyloadxt/jquery.lazyloadxt.extra.js',
			'scrollmagic/ScrollMagic.min.js',
			'scrollmagic/plugins/debug.addIndicators.min.js',
			'scrollmagic/plugins/animation.gsap.min.js',
			'scrollmagic/plugins/animation.velocity.min.js',
	 	 	'main.js'
 	 	],null,'resources/assets/js')
		.browserSync({
			proxy:'http://bej.site'
		});
 });
