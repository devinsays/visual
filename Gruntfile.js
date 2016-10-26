'use strict';
module.exports = function(grunt) {

	// load all tasks
	require('load-grunt-tasks')(grunt, {scope: 'devDependencies'});

    grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		watch: {
			files: ['scss/*.scss'],
			tasks: 'sass',
			options: {
				livereload: true,
			},
		},
		sass: {
			default: {
		  		options : {
			  		style : 'expanded'
			  	},
			  	files: {
					'style.css':'scss/style.scss',
				}
			},
		},
		autoprefixer: {
            options: {
				browsers: ['> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1', 'ie 9']
			},
			single_file: {
				src: 'style.css',
				dest: 'style.css'
			}
		},
		concat: {
		    release: {
		        src: [
		            'js/theme.js'
		        ],
		        dest: 'js/theme.min.js',
		    }
		},
		uglify: {
		    release: {
		        src: 'js/theme.min.js',
		        dest: 'js/theme.min.js'
		    }
		},
		cssjanus: {
			theme: {
				options: {
					swapLtrRtlInUrl: false
				},
				files: [
					{
						src: 'style.css',
						dest: 'style-rtl.css'
					}
				]
			}
		},
	    replace: {
			styleVersion: {
				src: [
					'scss/style.scss',
				],
				overwrite: true,
				replacements: [{
					from: /Version:.*$/m,
					to: 'Version: <%= pkg.version %>'
				}]
			},
			functionsVersion: {
				src: [
					'functions.php'
				],
				overwrite: true,
				replacements: [ {
					from: /^define\( 'VISUAL_VERSION'.*$/m,
					to: 'define( \'VISUAL_VERSION\', \'<%= pkg.version %>\' );'
				} ]
			},
		}

	});

    grunt.registerTask( 'default', [
    	'sass',
		'autoprefixer',
    ]);

    grunt.registerTask( 'release', [
    	'replace',
    	'sass',
		'autoprefixer',
		'concat:release',
		'uglify:release',
		'cssjanus'
	]);

};