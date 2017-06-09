var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var rename = require('gulp-rename');

var jquerySRC         = "./node_modules/jquery/dist/jquery.min.js";
var tetherSRC         = "./node_modules/tether/dist/js/tether.min.js";
var bootstrapSRC      = "./node_modules/bootstrap/dist/js/bootstrap.min.js";

var mainStyleSCSS = "./source/sass/main.scss";

gulp.task('concat', function(){
  return gulp.src([jquerySRC,tetherSRC,bootstrapSRC])
    .pipe(concat('main.js'))
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