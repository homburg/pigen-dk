var gulp = require("gulp");
var $ = require("gulp-load-plugins")();
var mainBowerFiles = require("main-bower-files");

gulp.task("default", function () {
	gulp.src("app/*.styl")
	.pipe($.stylus())
	.pipe(gulp.dest("css"));

	gulp.src(mainBowerFiles())
	.pipe($.concat("vendor.js"))
	.pipe(gulp.dest("public"));

	gulp.src("app/*.coffee")
	.pipe($.coffee())
	.pipe(gulp.dest("public"));
});
