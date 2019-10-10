var gulp = require("gulp");
var $ = require("gulp-load-plugins")();
var mainBowerFiles = require("main-bower-files");

gulp.task("default", function () {
	gulp.src("app/*.styl")
	.pipe($.stylus())
	.pipe(gulp.dest("css"));

	gulp.src(mainBowerFiles().concat(["app/lib/*.js"]))
	.pipe($.debug())
	.pipe($.concat("vendor.js"))
	.pipe(gulp.dest('public'));

	gulp.src('bower_components/jquery/dist/jquery.min.map')
		.pipe(gulp.dest('public'));

	gulp.src("app/*.coffee")
	.pipe($.coffee())
	.pipe(gulp.dest('public'));
});
