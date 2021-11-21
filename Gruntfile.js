const sass = require('node-sass');

module.exports = function(grunt) {


  grunt.initConfig({
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        '../wp-bootstrap/library/js/*.js',
        'library/js/*.js',
        'library/admin/js/*.js',
      ]
    },
    sass: {
      options: {
        implementation: sass
      },
      dev: {
        options: {
          sourceMap: true
        },        
        files: {
          'library/dist/css/styles.css': ['library/scss/styles.scss'],
          'library/dist/admin/css/admin-styles.min.css': ['library/admin/scss/admin-styles.scss']
        } 
      },  
      prod: {
        options: {
          implementation: sass,
          style: 'compressed',
          sourceMap: false         
        },        
        files: {
          'library/dist/css/styles.css': 'library/scss/styles.scss',
          'library/dist/admin/css/admin-styles.min.css': 'library/admin/scss/admin-styles.scss'
        } 
      } 
    },
    browserify: {
        dist: {
          options: {
            transform: [['babelify', { 
              presets: ["es2015","stage-3"],
              extensions: [".js",".ts"] }],
              [ "browserify-shim" ]],
          },
          files: {
            'library/dist/js/scripts.min.js': [          
            'bower_components/chosen/chosen.jquery.js',
            'library/js/affix.js', 
            'library/js/scripts.js', 
            ]
          },
        },
        dev: {
          options: {
            transform: [['babelify', { 
              presets: ["es2015","stage-3"],
              extensions: [".js",".ts"] }],
              [ "browserify-shim" ]],
          },
          files: {
            'library/dist/js/scripts.min.js': [
            'bower_components/chosen/chosen.jquery.min.js',
            'library/js/affix.js', 
            'library/js/scripts.js'
            ]
          }
        }
      },
    terser: {
      dist: {
        files: {
          'library/dist/js/scripts.min.js': [          
          'library/dist/js/scripts.min.js', 
          ]
        },
        options: {
          compress: {
            drop_console: true
          }
        }
      },
      dev: {
        files: {
          'library/dist/js/scripts.min.js': [
          'library/dist/js/scripts.min.js'
          ]
        },
        options: {
          // JS source map: to enable, uncomment the lines below and update sourceMappingURL based on your install
          sourceMap :{
            root: "http://tony.local:8888/tonys-site/wp-content/themes/tones-child/",
            url: "scripts.min.js.map",
          },
        }     
      }
    },    // autoprefixer
    autoprefixer: {
        options: {
            browsers: ['last 2 versions', 'ie 9', 'ios 6', 'android 4'],
            map: true
        },
        files: {
            expand: true,
            flatten: true,
            src: 'library/dist/css/*.css',
            dest: 'library/dist/css'
        },
    },
    // css minify
    cssmin: {
      target: {
        files: [{
          expand: true,
          cwd: 'library/dist/css',
          src: ['*.css', '!*.min.css'],
          dest: 'library/dist/css',
          ext: '.css'
        }]
      }
    },   
    grunticon: {
      myIcons: {
          files: [{
            expand: true,
            cwd: 'library/img',
            src: ['*.svg', '*.png'],
            dest: "library/dist/img"
          }],
          options: {
            enhanceSVG: true
          }
      }
    },
    version: {
        assets: {
          files: {
            'functions.php': ['library/dist/css/styles.css', 'library/dist/js/scripts.min.js']
          }
        }        
    },
    watch: {
      sass: {
        files: [
          'library/scss/**/*.scss',
          'library/admin/scss/*.scss'
        ],
        tasks: ['clean:css', 'sass:dev', 'version', ]
      },

      js: {
        files: [
          '<%= jshint.all %>'
        ],
        tasks: ['clean:js', 'uglify:dev', 'version']
      }

    },
    browserSync: {
      dev: {
          bsFiles: {
              src : [
                  'library/dist/css/*',
                  'library/admin/css/*',
                  'library/dist/js/*',
                  'library/admin/js/*',
                  '**/*.php'
              ]
          },
          options: {
              watchTask: true,
              proxy: "tones.local:8888/tonys-site/"
          }
      }
    },
    clean: {
      dist: [
        'library/dist/css',
        'library/dist/js'
      ],
      js: [
        'library/dist/js'
      ],
      css: [
        'library/dist/css'
      ]
    }

  });

  // Load tasks
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-wp-assets');
  // grunt.loadNpmTasks('grunt-grunticon');
  // grunt.loadNpmTasks('grunt-svgstore');
  grunt.loadNpmTasks('grunt-browser-sync');

  // Register tasks
  grunt.registerTask('default', ['browserSync', 'watch']);

  grunt.registerTask('build', [
    'clean:dist',
    'sass:prod',
    'uglify:dist',
    // 'grunticon',    
    'autoprefixer',
    'cssmin',
    'version',

  ]);

};