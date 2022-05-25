'use strict'

const reader = require('readline-sync')
const glob = require('glob')
const fs = require('fs')

function get_inputs() {
	// ask for the plugin's name
	const inputName = reader.question(
		'Input plugin name. Use spaces and capitalization where appropriate: '
	)

	// ask for the plugin's description
	const inputDescription = reader.question('Input plugin description: ')

	return { name: inputName, description: inputDescription }
}

function generate_template_strings() {
	const inputs = get_inputs()

	const template = {
		name: inputs.name,
		description: inputs.description
	}

	// create variant of name separated by underscore for Class names
	template.class = inputs.name.replaceAll(' ', '_')

	// create variant of name all lowercase for variable and option names
	template.var = template.class.toLowerCase()

	// create variant of name all uppercase for const names
	template.const = template.class.toUpperCase()

	// create variant of the name file-system / slug friendly
	template.slug = inputs.name.replaceAll(' ', '-').toLowerCase()

	// create a variant with no spaces for namespace
	template.namespace = inputs.name.replaceAll(' ', '')

	return template
}

function updateDistPath(template, srcPath) {
	return srcPath
		.replaceAll('template-name', template.slug)
		.replace('src', 'dist/' + template.slug)
}

function generateFile(template, srcFile) {
	// get contents of file
	const srcData = fs.readFileSync(srcFile, 'utf8')

	// replace tags in file contents
	const distData = srcData
		.replaceAll('<%= template.name %>', template.name)
		.replaceAll('<%= template.description %>', template.description)
		.replaceAll('<%= template.class %>', template.class)
		.replaceAll('<%= template.var %>', template.var)
		.replaceAll('<%= template.const %>', template.const)
		.replaceAll('<%= template.slug %>', template.slug)
		.replaceAll('<%= template.namespace %>', template.namespace)

	// replace path with new path
	const distFile = updateDistPath(template, srcFile)

	// write new file
	fs.writeFile(distFile, distData, 'utf8', (err) => {
		if (err) return console.log(err)
	})
}

function generateDirectory(template, srcPath) {
	// replace path with new path
	const distPath = updateDistPath(template, srcPath)

	// write new directory
	fs.mkdirSync(distPath, { recursive: true })
}

function generatePlugin() {
	const template = generate_template_strings()
	console.log(template)

	// get all files in src directory
	// const srcFiles = getAllFilesInDirectory('src')
	// console.log(srcFiles)
	const srcFiles = glob.sync('src/**/*')
	console.log(srcFiles)
	if (!srcFiles) return
	const srcFilesCount = srcFiles.length

	for (let i = 0; i < srcFilesCount; i++) {
		// log progress
		const current = parseInt(i) + 1
		const percentage = Math.floor((current / srcFilesCount) * 100)
		console.log(
			`\n-- ${percentage}%, ${current} out of ${srcFilesCount} -- "${srcFiles[i]}"\n`
		)
		const srcFile = srcFiles[i]

		// generate directory if current is a directory
		if (fs.lstatSync(srcFile).isDirectory()) {
			generateDirectory(template, srcFile)
		}

		// generate file current is a file
		if (fs.lstatSync(srcFile).isFile()) {
			generateFile(template, srcFile)
		}
	}
	console.log('Finished.')
	return
}

generatePlugin()
