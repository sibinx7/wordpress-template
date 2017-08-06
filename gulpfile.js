var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var rename = require('gulp-rename');

var babel           = require("gulp-babel");
var gulpBrowserify  = require("gulp-browserify");
var browserify      = require("browserify");
var babelify        = require("babelify");
var source          = require("vinyl-source-stream")
var buffer          = require('vinyl-buffer');
var typeScript      = require('gulp-typescript');



var jquerySRC         = "./node_modules/jquery/dist/jquery.min.js";
var tetherSRC         = "./node_modules/tether/dist/js/tether.min.js";
var bootstrapSRC      = "./node_modules/bootstrap/dist/js/bootstrap.min.js";

var mainStyleSCSS = "./source/sass/main.scss";

gulp.task('concat', function(){
  return gulp.src([jquerySRC,tetherSRC,bootstrapSRC])
    .pipe(concat('main.js'))
    .pipe(gulp.dest('./js'))
});

gulp.task('concatBabelScript', function(){
	return browserify({
		entries: './js-scss/js/main.js'
	})
	.transform("babelify",{
		presets: ["es2015", "latest"]
	})
	.bundle()
	.pipe(source("main-es6.js"))
	.pipe(gulp.dest('./js'))
});

gulp.task('sass', function(){
  return gulp.src([mainStyleSCSS])
    .pipe(sass({
      outputStyle:'compressed'
    }))
    .pipe(rename('main.css'))
    .pipe(gulp.dest('./css'))
});
gulp.task('watch', function(){
  gulp.watch('./source/sass/**/*.scss',['sass']);
});
gulp.task('default',['concat','sass']);