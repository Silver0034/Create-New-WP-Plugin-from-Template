// <%= template.name %> Gulp File
'use strict'

const gulp = require('gulp')
const babel = require('gulp-babel')
const cleanCSS = require('gulp-clean-css')
const fs = require('fs')
const glob = require('glob')
const minify = require('gulp-minify')
const path = require('path')
const sass = require('gulp-sass')(require('sass'))
const sourcemaps = require('gulp-sourcemaps')

const globs = {
	admin: {
		styles: {
			input: './admin/scss',
			output: './admin/css'
		},
		scripts: {
			input: './admin/js',
			output: './admin/js'
		}
	},
	frontEnd: {
		styles: {
			input: './front-end/scss',
			output: './front-end/css'
		},
		scripts: {
			input: './front-end/js',
			output: './front-end/js'
		}
	}
}

/**
 * Create a distribution folder for the plugin
 */
function buildDist() {
	// get plugin directory name
	const directory = path.basename(__dirname)

	// empty the dist folder
	if (fs.existsSync('dist')) {
		fs.rmSync('dist', {
			recursive: true,
			force: true
		})
	}

	// make dist directory
	fs.mkdirSync('dist')
	fs.mkdirSync('dist/' + directory)

	// get files
	const files = glob.sync('**/*', {
		ignore: [
			'*.json',
			'*.js',
			'.*',
			'**/node_modules/**',
			'**/scss/**',
			'**/dist/**'
		]
	})

	// copy files
	for (let i = 0; i < files.length; i++) {
		const file = files[i]
		const output = `./dist/${directory}/${file}`

		if (!fs.statSync(file).isFile()) {
			fs.mkdirSync(output)
			continue
		}

		fs.copyFile(file, output, (err) => {
			if (err) throw err
		})
	}
}

/**
 * Build styles in input directory and place into output directory
 * @param string input
 * @param string output
 */
function buildStyles(input, output) {
	return gulp
		.src(`${input}/**/*.scss`)
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(cleanCSS({ compatibility: 'ie8' }))
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest(output))
}

/**
 * Build the admin styles
 * @param function cb
 */
function buildAdminStyles(cb) {
	buildStyles(globs.admin.styles.input, globs.admin.styles.output)
	cb()
}

/**
 * Build the front end styles
 * @param function cb
 */
function buildFrontEndStyles(cb) {
	buildStyles(globs.frontEnd.styles.input, globs.frontEnd.styles.output)
	cb()
}

/**
 * Build scripts in input directory and place into output directory
 * @param string input
 * @param string output
 */
function buildScripts(input, output) {
	return gulp
		.src([`${input}/**/*.js`, `!${input}/**/*.min.js`])
		.pipe(
			babel({
				presets: ['@babel/env']
			}).on('error', console.error.bind(console))
		)
		.pipe(
			minify({
				ext: {
					min: '.min.js'
				},
				noSource: true
			}).on('error', console.error.bind(console))
		)
		.pipe(gulp.dest(output))
}

/**
 * Build admin scripts
 * @param function cb
 */
function buildAdminScripts(cb) {
	buildScripts(globs.admin.scripts.input, globs.admin.scripts.output)
	cb()
}

/**
 * Build front end scripts
 * @param function cb
 */
function buildFrontEndScripts(cb) {
	buildScripts(globs.frontEnd.scripts.input, globs.frontEnd.scripts.output)
	cb()
}

/**
 * Build admin styles and scripts
 * @param function cb
 */
function buildAdminFiles(cb) {
	buildStyles(globs.admin.styles.input, globs.admin.styles.output)
	buildScripts(globs.admin.scripts.input, globs.admin.scripts.output)
	cb()
}

/**
 * Build front end styles and scripts
 * @param function cb
 */
function buildFrontEndFiles(cb) {
	buildStyles(globs.frontEnd.styles.input, globs.frontEnd.styles.output)
	buildScripts(globs.frontEnd.scripts.input, globs.frontEnd.scripts.output)
	cb()
}

/**
 * Build the distribution folder
 * @param function cb
 */
gulp.task('build', (cb) => {
	buildDist()
	cb()
})

// Admin gulp functions
gulp.task('admin-styles', buildAdminStyles)
gulp.task('admin-scripts', buildAdminScripts)
gulp.task('admin', buildAdminFiles)
gulp.task('watch-admin-styles', () => {
	gulp.watch(`${globs.admin.styles.input}/**/*.scss`, buildAdminStyles)
})
gulp.task('watch-admin-scripts', () => {
	gulp.watch(`${globs.admin.scripts.input}/**/*.js`, buildAdminScripts)
})
gulp.task('watch-admin', () => {
	gulp.watch(`${globs.admin.styles.input}/**/*.scss`, buildAdminFiles)
	gulp.watch(`${globs.admin.scripts.input}/**/*.js`, buildAdminFiles)
})

// Front end functions
gulp.task('front-end-styles', buildFrontEndStyles)
gulp.task('front-end-scripts', buildFrontEndScripts)
gulp.task('front-end', buildFrontEndFiles)
gulp.task('watch-front-end-styles', () => {
	gulp.watch(`${globs.frontEnd.styles.input}/**/*.scss`, buildFrontEndStyles)
})
gulp.task('watch-front-end-scripts', () => {
	gulp.watch(`${globs.frontEnd.scripts.input}/**/*.js`, buildFrontEndScripts)
})
gulp.task('watch-front-end', () => {
	gulp.watch(`${globs.frontEnd.styles.input}/**/*.scss`, buildFrontEndFiles)
	gulp.watch(`${globs.frontEnd.scripts.input}/**/*.js`, buildFrontEndFiles)
})

// default
gulp.task('default', () => {
	gulp.watch(`${globs.admin.styles.input}/**/*.scss`, buildAdminFiles)
	gulp.watch(`${globs.admin.scripts.input}/**/*.js`, buildAdminFiles)
	gulp.watch(`${globs.frontEnd.styles.input}/**/*.scss`, buildFrontEndFiles)
	gulp.watch(`${globs.frontEnd.scripts.input}/**/*.js`, buildFrontEndFiles)
})
