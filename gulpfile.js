var gulp = require("gulp");
var $ = require("gulp-load-plugins")();

gulp.task("default", function () {
	gulp.src("app/*.styl")
	.pipe($.stylus())
	.pipe(gulp.dest("css"))
});
