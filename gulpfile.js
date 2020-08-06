var elixir = require('laravel-elixir');

//// for gulp minify
//var gulp = require('gulp');
//var minifycss = require('gulp-minify-css');
//var autoprefixer = require('gulp-autoprefixer');

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
    mix.sass('pro_style.sass')
        .styles(['pro_animate.min.css','font-awesome-animation.min.css','font-awesome.min.css','pro_checkbox.css','pro_style.css'],null,'public/css')
        .version('public/css/all.css');
});
//// for minify css
//gulp.task('css', function(){
//	return gulp.src('public/css/all.css')
//                .pipe(autoprefixer('last 15 version'))
//				.pipe(minifycss())
//				.pipe(gulp.dest('public/css/min'))
//});
//
//gulp.task('default',function(){
//   gulp.run('css');
//});

