// <%= template.name %> Gulp File
'use strict'

const gulp = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const sourcemaps = require('gulp-sourcemaps')
const cleanCSS = require('gulp-clean-css')

const globs = {
	input: {
		admin: './admin/scss/**/*.scss',
		public: './public/scss/**/*.scss'
	},
	output: {
		admin: './admin/css',
		public: './public/css'
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

function buildPublicStyles(cb) {
	buildStyles(globs.input.public, globs.output.public)
	cb()
}

gulp.task('admin', (cb) => {
	buildStyles(globs.input.admin, globs.output.admin)
	cb()
})

gulp.task('public', (cb) => {
	buildStyles(globs.input.public, globs.output.public)
	cb()
})

gulp.task('default', (cb) => {
	buildStyles(globs.input.admin, globs.output.admin)
	buildStyles(globs.input.public, globs.output.public)
	cb()
})

gulp.task('watch-admin', () => {
	gulp.watch(globs.input.admin, buildAdminStyles)
})

gulp.task('watch-public', () => {
	gulp.watch(globs.input.public, buildPublicStyles)
})

gulp.task('watch', () => {
	gulp.watch(globs.input.admin, buildAdminStyles)
	gulp.watch(globs.input.public, buildPublicStyles)
})
