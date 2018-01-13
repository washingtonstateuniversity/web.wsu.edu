module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		stylelint: {
			src: [ "css/*.css" ]
		},

		concat: {
			options: {
				sourceMap: true
			},
			dist: {
				src: 'css/*.css',
				dest: 'tmp-style.css'
			}
		},

		postcss: {
			options: {
				map: true,
				diff: false,
				processors: [
					require( "autoprefixer" )( {
						browsers: [ "> 1%", "ie 8-11", "Firefox ESR" ]
					} )
				]
			},
			dist: {
				src: "tmp-style.css",
				dest: "style.css"
			}
		},

		clean: {
			options: {
				force: true
			},
			temp: [ 'tmp-style.css', 'tmp-style.css.map' ]
		},

		phpcs: {
			plugin: {
				src: './'
			},
			options: {
				bin: "vendor/bin/phpcs --extensions=php --ignore=\"*/vendor/*,*/node_modules/*\"",
				standard: "phpcs.ruleset.xml"
			}
		},

		watch: {
			styles: {
				files: [ "css/*.css", "js/*.js" ],
				tasks: [ "default" ],
				option: {
					livereload: 8000
				}
			}
		},

		connect: {
			server: {
				options: {
					open: "http://localhost:8000/style-guide/home.html",
					port: 8000,
					hostname: "localhost"
				}
			}
		}
	});

	grunt.loadNpmTasks( "grunt-postcss" );
	grunt.loadNpmTasks( "grunt-contrib-concat" );
	grunt.loadNpmTasks( "grunt-contrib-connect" );
	grunt.loadNpmTasks( "grunt-contrib-clean" );
	grunt.loadNpmTasks( "grunt-contrib-watch" );
	grunt.loadNpmTasks( "grunt-phpcs" );
	grunt.loadNpmTasks( "grunt-stylelint" );

	// Default task(s).
	grunt.registerTask( 'default', [ "stylelint", "concat", "postcss", "clean" ] );

	grunt.registerTask( "serve", [ "connect", "watch" ] );
};
