// <%= template.name %> Gulp File
'use strict'

const gulp = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const sourcemaps = require('gulp-sourcemaps')
const cleanCSS = require('gulp-clean-css')

const globs = {
	input: {
		admin: './admin/scss/**/*.scss',
		frontEnd: './front-end/scss/**/*.scss'
	},
	output: {
		admin: './admin/css',
		frontEnd: './front-end/css'
	}
}

function buildStyles(input, output) {
	return gulp
		.src(input)
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(cleanCSS({ compatibility: 'ie8' }))
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest(output))
}

function buildAdminStyles(cb) {
	buildStyles(globs.input.admin, globs.output.admin)
	cb()
}

function buildFrontEndStyles(cb) {
	buildStyles(globs.input.frontEnd, globs.output.frontEnd)
	cb()
}

gulp.task('admin', (cb) => {
	buildStyles(globs.input.admin, globs.output.admin)
	cb()
})

gulp.task('front-end', (cb) => {
	buildStyles(globs.input.frontEnd, globs.output.frontEnd)
	cb()
})

gulp.task('default', (cb) => {
	buildStyles(globs.input.admin, globs.output.admin)
	buildStyles(globs.input.frontEnd, globs.output.frontEnd)
	cb()
})

gulp.task('watch-admin', () => {
	gulp.watch(globs.input.admin, buildAdminStyles)
})

gulp.task('watch-front-end', () => {
	gulp.watch(globs.input.frontEnd, buildFrontEndStyles)
})

gulp.task('watch', () => {
	gulp.watch(globs.input.admin, buildAdminStyles)
	gulp.watch(globs.input.frontEnd, buildFrontEndStyles)
})
